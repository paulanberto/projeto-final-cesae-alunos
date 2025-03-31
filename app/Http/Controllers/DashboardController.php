<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    public function getDashboard()
    {

        //buscar todas as informaçoes que interessam sobre o user
        // $user = Auth::user();
        // $points = null;
        // $courseInfo = null;

        // if($user->user_type===0 ){

        //     $courseInfo = $user->course()-first();
        // }

        //return view('dashboard', compact('name', 'saldo_pontos', 'user_type', 'curso_id' ));
        return view('dashboard');
    }

    public function politicas()
    {
        return view('politicas');
    }
}
