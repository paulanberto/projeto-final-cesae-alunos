
<?php

use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Log;
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
use Illuminate\Foundation\Auth\EmailVerificationRequest;



Route::get('/', function () {
    return redirect('/tema');
});

//Rota de fallback para páginas não encontradas
Route::fallback(function () {
    return view('fallback');
});

//Rota para a página geral de design
Route::get('/design', [DesignController::class, 'index'])->name('design');

//Rota para a página de Politicas de Privacidade e regras
Route::get('/politicas', [DashboardController::class, 'politicas'])->name('politicas');



// Rotas de verificação de e-mail (acessíveis sem autenticação)
Route::get('/email/verify', function () {
    return view('auth.verify_email');
})->name('verification.notice');


Route::get('/email/verify/{id}', [UserController::class, 'verifyEmail'])
    ->name('verification.verify');


// Rota para processar o link de verificação enviado por e-mail
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    try {
        $request->fulfill();
        return redirect('/login')->with('success', 'E-mail verificado com sucesso! Agora você pode fazer login.');
    } catch (\Exception $e) {
        Log::error('Erro na verificação de e-mail: ' . $e->getMessage());
        return redirect('/login')->with('error', 'Ocorreu um erro ao verificar seu e-mail. Por favor, tente novamente.');
    }
})->middleware(['signed'])->name('verification.verify');

// Rota para reenvio do e-mail de verificação (sem necessidade de autenticação)
Route::post('/email/verification-notification', function (Request $request) {

    $email = $request->input('email') ?? session('register_email');

    if (!$email) {
        return back()->with('error', 'E-mail não fornecido.');
    }

    $user = \App\Models\User::where('email', $email)->first();

    if (!$user) {
        return back()->with('error', 'Não foi possível encontrar este e-mail. Por favor, verifique e tente novamente.');
    }

    if ($user->hasVerifiedEmail()) {
        return back()->with('success', 'E-mail já verificado. Você pode fazer login.');
    }

    $user->sendEmailVerificationNotification();
    return back()->with('message', 'E-mail de verificação reenviado!');
})->middleware(['throttle:6,1'])->name('verification.send');


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
    Route::post('/update-profile-image', [DashboardController::class, 'updateProfileImage'])->name('update.profile.image');
    Route::post('/user-delete', [DashboardController::class, 'deleteOwnAccount'])->name('account.delete');


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


        //rota para a página de adicionar materiais, feita para adicionar materiais, leva para o formulário de adição
        Route::get('/add', [MaterialController::class, 'addMaterial'])->name('material.add');

        //rota para colocar os materiais que criamos no formulário na base de dados
        Route::post('/create', [MaterialController::class, 'createMaterial'])->name('material.create');

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

        Route::delete('/delete/{id}', [ForumController::class, 'destroy'])->name('forum.delete');
        Route::get('/edit/{id}', [ForumController::class, 'edit'])->name('forum.edit');

        Route::post('/update', [ForumController::class, 'update'])->name('forum.update');

    });
});
