<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DesignController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/design', [DesignController::class, 'index'])->name('design');


Route::prefix('forum')->group(function() {

    Route::get('/', [ForumController::class, 'index'])->name('forum.index');

    /* Route::get('/{id}') */

});
