<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Access\AuthorizationException;


class UserController extends Controller
{
    public function addUsers()
    {
        $cursos = DB::table('cursos')->get();

        $anos = range(1980, 2030);

        return view('user.add_users', compact('cursos', 'anos'));
    }



    public function createUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'curso_id' => 'required|exists:cursos,id',
            'ano' => 'required|integer|between:1980,2030',
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
            'ano.required' => 'Por favor, selecione um ano',
            'ano.between' => 'O ano deve estar entre 1980 e 2030',
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

            $user = User::create([
                'curso_id' => $request->curso_id,
                'ano' => $request->ano,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            session(['register_email' => $user->email]);

            return redirect()->route('verification.notice')->with('success', 'Cadastro realizado com sucesso. Por favor, verifique seu e-mail para confirmar o registro.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao criar o usuário: ' . $e->getMessage())->withInput();
        }
    }

    public function verifyEmail($id)
    {
        try {
            // Encontrar o usuário pelo ID
            $user = User::findOrFail($id);

            // Se o e-mail já foi verificado
            if ($user->hasVerifiedEmail()) {
                return redirect('/login')->with('success', 'E-mail já foi verificado anteriormente. Você pode fazer login.');
            }

            // Verificar o e-mail
            $user->markEmailAsVerified();

            return redirect('/login')->with('success', 'E-mail verificado com sucesso! Agora você pode fazer login.');
        } catch (\Exception $e) {
            Log::error('Erro na verificação de e-mail: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Ocorreu um erro ao verificar seu e-mail. Por favor, tente novamente.');
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

        // Apply search if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
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

        return view('user.view_user', compact('user'));
    }

    public function editUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $cursos = DB::table('cursos')->get();

        $anoAtual = date('Y');
        $anos = [];
        for ($i = 0; $i <= 5; $i++) {
            $anos[] = $anoAtual + $i;
        }

        if (!$user) {
            return redirect()->route('users.view')->with('error', 'User not found.');
        }

        return view('user.edit_user', compact('user', 'cursos', 'anos'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'curso' => 'required|string|max:255',
            'ano' => 'required|integer|digits:4',
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/@msft\.cesae\.pt$/|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user->update([
                'curso' => $request->curso,
                'ano' => $request->ano,
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Se uma nova senha for fornecida, atualize-a
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|confirmed|min:8',
                ]);
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            return redirect()->route('users.list')->with('success', 'Usuário atualizado com sucesso.');
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
