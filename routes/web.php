
<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsModerador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DesignController;
use App\Http\Middleware\IsAdminOrModerator;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

// Rota de fallback
Route::fallback(function () {
    return view('fallback');
});


Route::get('/design', [DesignController::class, 'index'])->name('design');

Route::get('/politicas', [DashboardController::class, 'politicas'])->name('politicas');

// Rota users
Route::get('/users', [UserController::class, 'listUsers'])->name('users.list');
Route::get('/add-users', [UserController::class, 'addUsers'])->name('users.add');
Route::post('/create-user', [UserController::class, 'createUser'])->name('users.create');

Route::middleware('auth')->group(function () {

    //todos os users (tabela)
    Route::get('/view-users', [UserController::class, 'viewUsers'])->name('users.view');

    // um só user (editar perfil)
    Route::get('/user/{id}', [UserController::class, 'viewUser'])->name('users.view.single');

    Route::get('/user/{id}/edit', [UserController::class, 'editUser'])->name('users.edit');

    Route::post('/user/{id}/update', [UserController::class, 'updateUser'])->name('users.update');

    Route::get('/user/{id}/delete', [UserController::class, 'deleteUserFromDB'])->name('users.delete');


    Route::get('/dashboard', action: [DashboardController::class, 'getDashboard'])->name('dashboard.view');




    Route::prefix('tema')->group(function () {

        Route::get('/', [TemaController::class, 'index'])->name('tema');

        Route::middleware([IsAdmin::class])->group(function () {
            //rota para a página de adicionar temas, feita para adicionar temas, leva para o formulário de adição
            Route::get('/add', [TemaController::class, 'addTema'])->name('tema.add');

            //rota para colocar as temas que criamos no formulário no base de dados
            Route::post('/create', [TemaController::class, 'createTema'])->name('tema.create');

            //rota para deletar temas
            Route::delete('/delete/{id}', [TemaController::class, 'deleteTema'])->name('tema.delete');


            Route::delete('delete-multiple', [TemaController::class, 'deleteTema'])->name('tema.deleteMultiple');
        });


        //rota para deletar temas
        Route::get('/delete/{id}', [TemaController::class, 'deleteTema'])->name('tema.delete');
    });

    Route::get('/tema/{id}/material', [MaterialController::class, 'showMaterial'])->name('tema.material');

    Route::get('/material/tema/{id}', [MaterialController::class, 'showMaterial'])->name('material.show');

    Route::get('/material/detalhes/{id}', [MaterialController::class, 'showDetalhes'])->name('material.detalhes');

    Route::prefix('material')->group(function () {

        Route::get('/', [MaterialController::class, 'index'])->name('material');

        //rota para a página de adicionar materiais, feita para adicionar materiais, leva para o formulário de adição
        Route::get('/add', [MaterialController::class, 'addMaterial'])->name('material.add');

        //rota para colocar os materiais que criamos no formulário na base de dados
        Route::post('/create', [MaterialController::class, 'createMaterial'])->name('material.create');



        // Rota para excluir um material
        Route::delete('/delete/{id}', [MaterialController::class, 'deleteMaterial'])->name('material.delete')->middleware([IsAdminOrModerator::class]);

        // Rota para excluir mais de um material ao mesmo tempo
        Route::delete('delete-multiple', [MaterialController::class, 'deleteMaterial'])->name('material.deleteMultiple')->middleware([IsAdminOrModerator::class]);
    });


    Route::prefix('forum')->group(function () {

        Route::get('/', [ForumController::class, 'index'])->name('forum.index');

        Route::get('/list/{id}', [ForumController::class, 'list'])->name('forum.list');

        Route::get('/post/{id}', [ForumController::class, 'show'])->name('forum.show');

        Route::post('/comment', [ForumController::class, 'comment'])->name('forum.comment');
        
        Route::get('/create/{id}', [ForumController::class, 'create'])->name('forum.create');

        Route::post('/store', [ForumController::class, 'store'])->name('forum.store');

    });
});
