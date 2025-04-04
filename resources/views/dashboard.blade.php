@extends('layouts.fo_layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <section class="dashboard-section">
        <div class="card mb-12">
            <div class="row g-0 dashboard-card-area">
                <div class="col-md-3 dashboard-img-and-button ">
                    <img class="img-profile-dashboard"
                        src="{{ file_exists(public_path('imagens/profile/' . Auth::id() . '/profile-' . Auth::id() . '.jpg'))
                            ? asset('imagens/profile/' . Auth::id() . '/profile-' . Auth::id() . '.jpg')
                            : (file_exists(public_path('imagens/profile/' . Auth::id() . '/profile-' . Auth::id() . '.png'))
                                ? asset('imagens/profile/' . Auth::id() . '/profile-' . Auth::id() . '.png')
                                : (file_exists(public_path('imagens/profile/' . Auth::id() . '/profile-' . Auth::id() . '.jpeg'))
                                    ? asset('imagens/profile/' . Auth::id() . '/profile-' . Auth::id() . '.jpeg')
                                    : (file_exists(public_path('imagens/profile/' . Auth::id() . '/profile-' . Auth::id() . '.gif'))
                                        ? asset('imagens/profile/' . Auth::id() . '/profile-' . Auth::id() . '.gif')
                                        : '../imagens/profile-icon.png'))) }}"
                        class="img-fluid rounded-start" alt="Profile Image">
                    <div class="img-change-dashboard-button">
                        <form action="{{ route('update.profile.image') }}" method="POST" enctype="multipart/form-data"
                            id="profileImageForm">
                            @csrf
                            <input type="file" name="profile_image" id="profileImageInput" style="display: none;"
                                onchange="document.getElementById('profileImageForm').submit();">
                            <p><button class="botaoPrincipal rounded-pill px-3" type="button"
                                    onclick="document.getElementById('profileImageInput').click();">Alterar Imagem</button>
                            </p>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h3 class="fonteBold">
                            @switch(Auth::user()->user_type)
                                @case(0)
                                    Aluno
                                @break

                                @case(1)
                                    Moderador
                                @break

                                @case(2)
                                    Administrador
                                @endswitch
                            </h3>
                            <ul>
                                @if (Auth::user()->user_type === 0)
                                    <li class="fontePrincipal">{{ Auth::user()->name }}</li>
                                    @if (isset(Auth::user()->curso->nome))
                                        <li class="fontePrincipal">{{ Auth::user()->curso->nome }}</li>
                                    @endif
                                    @if (isset(Auth::user()->saldo_pontos))
                                        <li class="fontePrincipal">Pontos: {{ Auth::user()->saldo_pontos }}</li>
                                    @endif
                                @elseif(Auth::user()->user_type === 1)
                                    <li class="fontePrincipal">{{ Auth::user()->name }}</li>
                                @elseif(Auth::user()->user_type === 2)
                                    <li class="fontePrincipal">{{ Auth::user()->name }}</li>
                                @endif
                            </ul>
                            <p class="fontePrincipal"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="empty-space"></div>

            @if (Auth::user()->user_type === 2)
                <div class="card mb-12">
                    <a class="users-browse" href="{{ route('users.view') }}">
                        <div class="row g-0 dashboard-card-area">
                            <div class="col-md-3 dashboard-img-and-button ">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h3 class="fonteBold">Consultar lista de Utilizadores</h3>
                                    <p class="card-text fontePrincipal">Aqui pode consultar e fazer alterações relativas a todos
                                        os
                                        utilizadores.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <div class="empty-space"></div>

            @auth
                @if (Auth::user()->user_type === 0)
                    <div class="card mb-12">
                        <a href="#" class="delete-own-account" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <div class="row g-0 dashboard-card-area">
                                <div class="col-md-3 dashboard-img-and-button">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body" id="delete-own-account-text">
                                        <h3 class="fonteBold">Apagar Conta</h3>
                                        <p class="card-text fontePrincipal">Aqui pode apagar a sua conta do nosso sistema.</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- ==================================Modal de confirmacao para apagar conta================= -->
                    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteAccountModalLabel">Confirmar Exclusão da Conta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza que deseja apagar sua conta? Esta acção não é reversivel.</p>
                                    <p>Todos os seus dados, incluindo posts e questões, serão permanentemente removidos.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('account.delete') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Sim, Apagar a minha conta do CodigoAberto</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </section>
    @endsection
