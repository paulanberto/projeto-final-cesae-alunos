
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DashboardController;


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

Route::get('/tema', [TemaController::class, 'index'])->name('tema');


//Route::middleware(['auth'])->group(function(){
//rota para a página de adicionar temas, feita para adicionar temas, leva para o formulário de adição
Route::get('/addtema', [TemaController::class, 'addTema'])->name('tema.add');

//rota para colocar as temas que criamos no formulário no base de dados
Route::post('/create-tema', [TemaController::class,'createTema'])->name('tema.create');

//rota para deletar temas
Route::get('/delete-tema/{id}', [TemaController::class,'deleteTema'])->name('tema.delete');
//  });


Route::get('/material', [MaterialController::class, 'index'])->name('material');

//Route::middleware(['auth'])->group(function(){
//rota para a página de adicionar materiais, feita para adicionar materiais, leva para o formulário de adição
Route::get('/addmaterial', [MaterialController::class, 'addMaterial'])->name('material.add');

//rota para colocar os materiais que criamos no formulário na base de dados
Route::post('/create-material', [MaterialController::class,'createMaterial'])->name('material.create');

//rota para deletar materiais
Route::get('/delete-material/{id}', [MaterialController::class,'deleteMaterial'])->name('material.delete');
//  });


Route::middleware('auth')->group(function() {

    Route::prefix('forum')->group(function() {

        Route::get('/', [ForumController::class, 'index'])->name('forum.index');

        Route::get('/list/{id}', ForumController::class, 'list')->name('forum.list');

        Route::get('/post/{id}', ForumController::class, 'show')->name('forum.show');

    });
});



Route::get('/dashboard', action: [DashboardController::class, 'getDashboard'])->name('dashboard.view');
