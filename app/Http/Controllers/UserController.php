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




    //buscar os dados dos users para a blade "view_users"
    public function viewUsers()
    {
        $search = request()->query('search');

        $query = DB::table('users')
            ->leftJoin('cursos', 'users.curso_id', '=', 'cursos.id')
            ->select('users.*', 'cursos.nome as curso_nome');

        // Apply search if provided
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%");

                // Only include curso search if the table exists
                if (Schema::hasTable('cursos')) {
                    $q->orWhere('cursos.nome', 'like', "%{$search}%");
                }
            });
        }

        $users = $query->get();

        return view('user.view_users', compact('users'));
    }

    // Combined view and edit user page
    public function viewUser($id)
    {
        $user = DB::table('users')
            ->leftJoin('cursos', 'users.curso_id', '=', 'cursos.id')
            ->select('users.*', 'cursos.nome as curso_nome')
            ->where('users.id', $id)
            ->first();

        if (!$user) {
            return redirect()->route('users.view')->with('error', 'User not found.');
        }

        // Get all courses for edit mode
        $cursos = DB::table('cursos')->get();

        // Check if we should show edit mode
        $editMode = request()->has('edit');

        return view('user.user_details', compact('user', 'cursos', 'editMode'));
    }

//backup

    // public function viewUser($id)
    // {
    //     $user = DB::table('users')
    //         ->leftJoin('cursos', 'users.curso_id', '=', 'cursos.id')
    //         ->select('users.*', 'cursos.nome as curso_nome')
    //         ->where('users.id', $id)
    //         ->first();

    //     if (!$user) {
    //         return redirect()->route('users.view')->with('error', 'User not found.');
    //     }

    //     return view('user.view_user', compact('user'));
    // }




    public function deleteUserFromDB($id)
    {

        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('users.view')->with('success', 'User deleted successfully.');
        // db::table('users')->where('id', $id)->delete();
        // return back();
    }




    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/@cesae\.pt$/',
            'curso_id' => 'nullable|exists:cursos,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'curso_id' => $request->curso_id,
        ];

        DB::table('users')->where('id', $id)->update($userData);

        return redirect()->route('users.view')->with('success', 'User updated successfully.');
    }





}
