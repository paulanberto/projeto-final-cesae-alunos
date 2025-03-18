<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function addUsers()
    {
        return view('user.add_users');
    }

    public function createUser(Request $request)
    {

        // Validar os dados de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|regex:/@cesae\.pt$/', // Validando o domínio do email
            'password' => 'required|string|confirmed|min:8', // Confirmar senha e garantir que tenha pelo menos 8 caracteres
            'termos' => 'required|accepted', // Garantir que os termos foram aceitos
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Criar o novo usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirecionar para a página de login com uma mensagem de sucesso
        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso. Por favor, faça login.');
    }





    public function viewUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        return view('users.view_user', compact('user'));
    }



    public function deleteUserFromDB($id)
    {

        db::table('users')->where('id', $id)->delete();

        return back();
    }
}
