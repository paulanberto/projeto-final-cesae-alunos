@extends('layouts.fo_layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <section class="dashboard-section">
        <div class="card mb-12">
            <div class="row g-0 dashboard-card-area">
                <div class="col-md-3 dashboard-img-and-button ">
                    <img class="img-profile-dashboard" src="../imagens/profile-icon.png" class="img-fluid rounded-start"
                        alt="...">
                    <div class="img-change-dashboard-button">
                        <p><button class="botaoPrincipal rounded-pill px-3" type="button">Alterar Imagem</button></p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-title ">
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
                                </h2>
                                <ul>
                                    @if (Auth::user()->user_type === 0)
                                        <li>Nome: {{ Auth::user()->name }}</li>
                                        @if (isset(Auth::user()->curso->nome))
                                            <li>{{ Auth::user()->curso->nome }}</li>
                                        @endif
                                        @if (isset(Auth::user()->saldo_pontos))
                                            <li>Pontos: {{ Auth::user()->saldo_pontos }}</li>
                                        @endif
                                    @elseif(Auth::user()->user_type === 1)
                                        <li>Nome: {{ Auth::user()->name }}</li>
                                    @elseif(Auth::user()->user_type === 2)
                                        <li>Nome: {{ Auth::user()->name }}</li>
                                    @endif
                                </ul>
                                <p class="card-text fontePrincipal"></p>
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
                                    <h5 class="fonteBold">Consultar lista de Utilizadores</h5>
                                    <p class="card-text fontePrincipal">Aqui pode consultar e fazer alterações relativas a todos os
                                        utilizadores.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <div class="empty-space"></div>


            {{-- Area para contribuiçoes feitas por este utilizador --}}


            <section class="posts-questions-section">
                @auth
                    @if (Auth::user()->user_type === 0)
                        <div class="card mb-12">
                            <a class="posts-questions-button" href="">
                                <div class="row g-0 dashboard-card-area">
                                    <!-- Icon column (1/6) -->
                                    <div class="col-2 dashboard-img-and-button d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-comments"></i>
                                    </div>



                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Posts</h5>
                                            <p class="card-text fonteprincipal">Consultar histórico de Posts.</p>
                                        </div>
                                    </div>

                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <p class="card-text m-0 fw-bold">
                                           0 {{-- {{ $ }} --}}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="empty-space"></div>

                        <div class="card mb-12">
                            <a class="posts-questions-button" href="">
                                <div class="row g-0 dashboard-card-area">

                                    <div class="col-2 dashboard-img-and-button d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-question"></i>
                                    </div>


                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Questões</h5>
                                            <p class="card-text">Consultar histórico Questões.</p>
                                        </div>
                                    </div>


                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <p class="card-text m-0 fw-bold">
                                           0 {{-- {{ $ }} --}}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endauth

            </section>



            <div class="empty-space"></div>

            @auth
                @if (Auth::user()->user_type === 0)
                    <div class="card mb-12">
                        <a class="delete-own-account" href="">
                            <div class="row g-0 dashboard-card-area">
                                <div class="col-md-3 dashboard-img-and-button ">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h5 class="card-title">Apagar Conta</h5>
                                        <p class="card-text">Aqui pode apagar a sua conta do nosso sistema.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endauth
        </section>
    @endsection
