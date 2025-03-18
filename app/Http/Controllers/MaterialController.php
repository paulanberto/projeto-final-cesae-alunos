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


    public function getAllMaterialFromDB(){
        $tema = DB::table('posts')
        ->get();
     return $tema;
    }

     public function addMaterial(){
    //     // if (!auth()->user()->isAdmin()) {
    //     //     return redirect()->route('tema')->with('error', 'Apenas administradores podem acessar esta página.');
    //     // }
        return view('material.addmaterial');
    }

    // public function createMaterial(Request $request){

    //     // if (!auth()->user()->isAdmin()) {
    //     //     return redirect()->back()->with('error', 'Apenas administradores podem criar temas.');
    //     // }

    //     $request->validate([
    //     'nome' => 'required|string|max:255',
    //     'descricao' => 'required|string|max:255',
    //     'icons' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    // ]);

    // $iconPath = $request->file('icons')->store('temaIcons', 'public');

    // Tema::create([
    //     'nome' => $request->nome,
    //     'descricao' => $request->descricao,
    //     'icons' => $iconPath

    // ]);

    //     return redirect()->route('tema')->with('message', 'Tema adicionado com sucesso');
    // }

    public function deleteMaterial(Request $request)
    {
        // Se receber um array de IDs (exclusão múltipla)
        if($request->has('materials')) {
            foreach($request->materials as $id) {
                DB::table('posts')
                    ->where('id', $id)
                    ->delete();
            }
            return back()->with('success', 'Materiais excluídos com sucesso');
        }
        // Se receber um único ID (exclusão individual)
        else if($request->id) {
            DB::table('posts')
                ->where('id', $request->id)
                ->delete();
            return back();
        }

        return back()->with('error', 'Nenhum item selecionado');
    }
}
