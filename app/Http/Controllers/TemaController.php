<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemaController extends Controller
{
    public function index()
    {
        $tema = $this->getAllTemaFromDB();
        return view('tema.tema', compact('tema'));
    }


    public function getAllTemaFromDB(){
        $tema = DB::table('categorias')
        ->get();
        return $tema;
    }

    public function addTema(){
        return view('tema.addtema');
    }

    public function createTema(Request $request){


        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'icons' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $iconPath = $request->file('icons')->store('temaIcons', 'public');


        DB::table('categorias')->insert([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'icons' => $iconPath,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('tema')->with('message', 'Tema adicionado com sucesso');
    }

    public function deleteTema(Request $request){


        if($request->has('temas')) {
            foreach($request->temas as $id) {
                DB::table('categorias')
                    ->where('id', $id)
                    ->delete();
            }

            return redirect()->route('tema')->with('success', 'Temas excluídos com sucesso');
        }

        else if($request->has('id')) {
            DB::table('categorias')
                ->where('id', $request->id)
                ->delete();
            return redirect()->route('material')->with('success', 'Tema excluído com sucesso');
        }
    }

}
