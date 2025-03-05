<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesignController;

Route::get('/', function () {
    return view('welcome');
});

// Rota de fallback
Route::fallback(function () {
    return view('falback');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/design', [DesignController::class, 'index'])->name('design');

// Rota users
Route::get('/add-users', [UserController::class, 'addUsers'])->name('users.add');
Route::post('/create-user', [UserController::class, 'createUser'])->name('users.create');
