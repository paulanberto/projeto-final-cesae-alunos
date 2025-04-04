<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function addUsers()
    {
        $cursos = DB::table('cursos')->get();
        return view('user.add_users', compact('cursos'));
    }



    public function createUser(Request $request)
    {
        // Validar os dados de entrada
        $validator = Validator::make($request->all(), [
            'curso_id' => 'required|exists:cursos,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|regex:/@msft\.cesae\.pt$/',
            'email_confirmation' => 'required|email|same:email',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]/',
            ],
            'termos' => 'required|accepted',
        ], [
            'curso_id.required' => 'Por favor, selecione um curso',
            'curso_id.exists' => 'O curso selecionado não é válido',
            'email.regex' => 'O email deve ser do domínio @msft.cesae.pt',
            'email_confirmation.same' => 'A confirmação de email não corresponde ao email fornecido',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres',
            'password.regex' => 'A senha deve conter pelo menos uma letra, um número e um símbolo',
            'termos.required' => 'Você deve aceitar os termos e condições',
            'termos.accepted' => 'Você deve aceitar os termos e condições',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        try {
            // Criar o novo usuário
            $user = User::create([
                'curso_id' => $request->curso_id, // Salvar o ID do curso
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Redirecionar para a página de login com uma mensagem de sucesso
            return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso. Por favor, faça login.');
        } catch (\Exception $e) {
            // Em caso de erro, redirecionar de volta com mensagem de erro
            return redirect()->back()->with('error', 'Ocorreu um erro ao criar o usuário: ' . $e->getMessage())->withInput();
        }
    }

    public function listUsers()
    {
        $users = User::all();
        return view('user.list_users', compact('users'));
    }
    //buscar os dados dos users para a blade "view_users"
    public function viewUsers()
    {
        $search = request()->query('search');

        $query = DB::table('users')
            ->leftJoin('cursos', 'users.curso_id', '=', 'cursos.id')
            ->select('users.*', 'cursos.nome as curso_nome');


        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%");


                if (Schema::hasTable('cursos')) {
                    $q->orWhere('cursos.nome', 'like', "%{$search}%");
                }
            });
        }


        $users = $query->paginate(15);


        if ($search) {
            $users->appends(['search' => $search]);
        }

        return view('user.view_users', compact('users'));
    }



    public function viewUser($id)
    {
        $user = DB::table('users')
            ->leftJoin('cursos', 'users.curso_id', '=', 'cursos.id')
            ->select('users.*', 'cursos.nome as curso_nome')
            ->where('users.id', $id)
            ->first();

        if (!$user) {
            return redirect()->route('users.view')->with('error', 'Utilizadores não disponiveis.');
        }

        return view('user.view_user', compact('user'));
    }

    public function editUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $cursos = DB::table('cursos')->get();

        if (!$user) {
            return redirect()->route('users.view')->with('error', 'User not found.');
        }

        return view('user.edit_user', compact('user', 'cursos'));
    }

    public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'curso_id' => 'required|exists:cursos,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|regex:/@msft\.cesae\.pt$/|unique:users,email,' . $id,
        'saldo_pontos' => 'required|integer|min:0', // Validate points
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        $user->update([
            'curso_id' => $request->curso_id,
            'name' => $request->name,
            'email' => $request->email,
            'saldo_pontos' => $request->saldo_pontos, // Update points
        ]);

        // If a new password is provided, update it
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|confirmed|min:8',
            ]);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.view.single', $id)->with('success', 'Usuário atualizado com sucesso.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o usuário: ' . $e->getMessage())->withInput();
    }
}

    public function deleteUserFromDB($id)
    {

        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('users.view')->with('success', 'Perfil apagado com sucesso.');
        // db::table('users')->where('id', $id)->delete();
        // return back();
    }

}
