@extends('layouts.fo_layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <section class="dashboard-section">
        <div class="card mb-12">
            <div class="row g-0 dashboard-card-area">
                <div class="col-md-3 dashboard-img-and-button ">
                    <img class="img-profile-dashboard" src="../imagens/dashboard_test_img.jpg" class="img-fluid rounded-start"
                        alt="...">
                    <div class="img-change-dashboard-button">
                        <p><button class="botaoPrincipal rounded-pill px-3" type="button">Alterar Imagem</button></p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{-- @switch(Auth::user()->user_type)
                                @case(0)
                                    Aluno
                                @break

                                @case(1)
                                    Moderador
                                @break

                                @case(2)
                                    Administrador
                                @endswitch --}}
                        </h5>
                        <ul>
                            {{-- @if (Auth::user()->user_type === 0) --}}
                            <li>Nome:</li>
                            <li>Curso:?course where the student is in, from database?</li>
                            <li>Pontos:?points the student has, from database?</li>
                            {{-- @elseif(Auth::user()->user_type === 1) --}}
                            <li>Curso:?course where the moderator is in, from database?</li>
                            {{-- @elseif(Auth::user()->user_type === 2) --}}
                            {{-- @endif --}}
                            <li>Nome:</li>
                            <li>Curso:</li>
                            <li>Pontos:</li>
                        </ul>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="empty-space"></div>

        {{-- @auth
                @if (Auth::user()->user_type === 2) --}}
        <div class="card mb-12">
            <a class=" users-browse" href="">
                <div class="row g-0 dashboard-card-area">
                    <div class="col-md-3 dashboard-img-and-button ">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">Consultar lista de Utilizadores</h5>
                            <p class="card-text">Aqui pode consultar e fazer alterações relativas a todos os
                                utilizadores.
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {{-- @endif
            @endauth --}}


        <div class="empty-space"></div>

        {{-- @auth
                @if (Auth::user()->user_type === 0) --}}
        <div class="card mb-12">
            <a class=" users-browse" href="">
                <div class="row g-0 dashboard-card-area">
                    <div class="col-md-3 dashboard-img-and-button ">
                        <i class="fa-solid fa-trash"></i>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">Apagar conta.</h5>
                            <p class="card-text">Aqui pode apagar a sua conta do nosso sistema.
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {{-- @endif
        @endauth --}}
    </section>
@endsection
