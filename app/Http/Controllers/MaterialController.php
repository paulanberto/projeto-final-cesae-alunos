<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('material.material', compact('categoria', 'material'));
    }

    public function showDetalhes(string $id)
    {

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

        return view('material.detalhesmaterial', compact('material'));
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

    public function createMaterial(Request $request){
        $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string|max:255',
            'ficheiro' => 'required|file|max:5120',
            'categoria_id' => 'required|exists:categorias,id'
        ]);


        $ficheiro = $request->file('ficheiro')->store('materialFicheiro', 'public');


        $postTypeId = 1;

        try {

            $id = DB::table('posts')->insertGetId([
                'post_type_id' => $postTypeId,
                'user_id' => auth()->user()->id,
                'categoria_id' => $request->categoria_id,
                'titulo' => $request->titulo,
                'texto' => $request->texto,
                'ficheiro' => $ficheiro,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('material.show', ['id' => $request->categoria_id])
                ->with('message', 'Material adicionado com sucesso (ID: ' . $id . ')');
        } catch (\Exception $e) {

            return back()->with('error', 'Erro ao adicionar material: ' . $e->getMessage());
        }
    }

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
