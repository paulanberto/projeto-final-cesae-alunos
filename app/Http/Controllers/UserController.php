<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function addUsers()
    {
        return view('user.add_users');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        User::insert(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),

            ]
        );

        return redirect()->route('login')->with('message', 'User adicionado com sucesso');
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
