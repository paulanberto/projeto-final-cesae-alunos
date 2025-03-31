<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $material = $this->getAllMaterialFromDB();
        return view('material.material', compact('material'));
    }

    public function showMaterial(string $id){
        $categoria = DB::table('categorias')
        ->where('id', $id)
        ->first();


        $material = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->join('categorias', 'posts.categoria_id', '=', 'categorias.id')
        ->where('posts.categoria_id', $id)
        ->select('posts.*', 'users.name as user_name')
        ->get();

        return view('material.material', compact('categoria', 'material', 'id'));
    }

    public function showDetalhes(string $id){

        $user = auth()->user();

        $material = DB::table('posts')
        ->join('categorias', 'posts.categoria_id', '=', 'categorias.id')
        ->select('posts.*', 'categorias.id as categoria_id')
        ->where('posts.id', $id)
        ->first();

        if (!$material) {
            return redirect()->route('material')->with('error', 'Material não encontrado');
        }

        if ($user->saldo_pontos < 1) {
            return redirect()->route('material.show', ['id' => $material->categoria_id])
                ->with('error', 'Você não tem pontos suficientes para acessar este material.');
        }

        $key = 'material_accessed_' . $id;

        if (!session()->has($key)) {

            DB::table('users')
                ->where('id', $user->id)
                ->decrement('saldo_pontos', 1);

            $updatedUser = DB::table('users')->where('id', $user->id)->first();

            session()->flash('points_message', "Você acessou o material e gastou 1 ponto. Seu saldo atual é de {$updatedUser->saldo_pontos} pontos.");

            session()->put($key, true);
        }

        $material = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('categorias', 'posts.categoria_id', '=', 'categorias.id')
            ->select(
                'posts.*',
                'users.name as user_name',
                'categorias.nome as categoria_nome',
                'ficheiro'
            )
            ->where('posts.id', $id)
            ->first();

        if (!$material) {
            return redirect()->route('material')->with('error', 'Material não encontrado');
        }

        $fileExtension = pathinfo($material->ficheiro, PATHINFO_EXTENSION);
        $fileType = $this->determineFileType($fileExtension);

        return view('material.detalhesmaterial', compact('material', 'fileType'));
    }

    private function determineFileType($extension) {
        $imageExtensions = ['jpg', 'jpeg', 'png'];
        $videoExtensions = ['mp4', 'avi', 'mov'];
        $documentExtensions = ['pdf', 'doc', 'docx', 'txt'];

        if (in_array(strtolower($extension), $imageExtensions)) {
            return 'image';
        } elseif (in_array(strtolower($extension), $videoExtensions)) {
            return 'video';
        } elseif (in_array(strtolower($extension), $documentExtensions)) {
            return 'document';
        }

        return 'unknown';
    }

    public function getAllMaterialFromDB(){
        $material = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('categorias', 'posts.categoria_id', '=', 'categorias.id')
            ->select('posts.*', 'users.name as user_name', 'categorias.nome as categoria_nome')
            ->get();
        return $material;
    }

    public function addMaterial(Request $request){
        $categoriaId = $request->categoria_id;
        $categoria = DB::table('categorias')->where('id', $categoriaId)->first();

        return view('material.addmaterial', compact('categoria', 'categoriaId'));
    }

    public function createMaterial(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string|max:255',
            'ficheiro' => 'required|file|max:5120',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $user = auth()->user();

        $ficheiro = $request->file('ficheiro')->store('materialFicheiro', 'public');

        $postTypeId = 1;

        try {
            $id = DB::table('posts')->insertGetId([
                'post_type_id' => $postTypeId,
                'user_id' => $user->id,
                'categoria_id' => $request->categoria_id,
                'titulo' => $request->titulo,
                'texto' => $request->texto,
                'ficheiro' => $ficheiro,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('users')
                ->where('id', $user->id)
                ->increment('saldo_pontos', 5);

            $updatedUser = DB::table('users')->where('id', $user->id)->first();

            return redirect()->route('material.show', ['id' => $request->categoria_id])
                ->with('message', 'Material adicionado com sucesso!')
                ->with('points_message', "Parabéns! Você ganhou 5 pontos. Seu saldo atual é de {$updatedUser->saldo_pontos} pontos.");

        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao adicionar material: ' . $e->getMessage());
        }
    }

    // public function comment(Request $request)
    // {
    //     $request->validate([
    //         'texto' => 'required|string',
    //         'parent_id' => 'required|exists:posts,id',
    //         'categoria_id' => 'required | exists:categorias,id'
    //     ]);


    //     Post::create([
    //         'user_id' => Auth::id(),
    //         'categoria_id' => $request->categoria_id,
    //         'post_type_id' => 4,
    //         'texto' => $request->texto,
    //         'parent_id' => $request->parent_id
    //     ]);

    //     return redirect()->back();
    // }

    public function deleteMaterial(Request $request){


        if($request->has('materiais')) {
            foreach($request->materiais as $id) {
                DB::table('posts')
                    ->where('id', $id)
                    ->delete();
            }

            return redirect()->route('material')->with('success', 'Materiais excluídos com sucesso');
        }

        else if($request->has('id')) {
            DB::table('posts')
                ->where('id', $request->id)
                ->delete();
            return redirect()->route('material')->with('success', 'Material excluído com sucesso');
        }
    }
}
