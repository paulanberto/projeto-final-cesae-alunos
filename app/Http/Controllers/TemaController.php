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
        // if (!auth()->user()->isAdmin()) {
        //     return redirect()->route('tema')->with('error', 'Apenas administradores podem acessar esta página.');
        // }
        return view('tema.addtema');
    }

    public function createTema(Request $request){

        // if (!auth()->user()->isAdmin()) {
        //     return redirect()->back()->with('error', 'Apenas administradores podem criar temas.');
        // }

        $request->validate([
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string|max:255',
        'icons' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $iconPath = $request->file('icons')->store('temaIcons', 'public');

    Tema::create([
        'nome' => $request->nome,
        'descricao' => $request->descricao,
        'icons' => $iconPath

    ]);

        return redirect()->route('tema')->with('message', 'Tema adicionado com sucesso');
    }

    public function deleteTema($id){

        // if (!auth()->user()->isAdmin()) {
        //     return redirect()->back()->with('error', 'Apenas administradores podem deletar temas.');
        // }
        DB::table('categorias')
        -> where ('id', $id)
        -> delete ();

        return back();
    }

}
