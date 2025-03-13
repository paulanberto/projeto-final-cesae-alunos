@extends('layouts.fo_layout')
@section('content')
    {{-- <h2>Welcome {{ Auth::user()->name }}</h2>

    @switch(Auth::user()->user_type)
        @case(0)
            <div class="alert alert-info" role="alert">
                Aluno
            </div>
        @break

        @case(1)
            <div class="alert alert-info" role="alert">
                Moderador
            </div>
        @break

        @case(2)
            <div class="alert alert-info" role="alert">
                Administrador
            </div>
        @break
    @endswitch --}}


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
                        <h5 class="card-title">Usertype</h5>
                        <ul>
                            <li>Curso:</li>
                            <li>Pontos:</li>
                        </ul>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="empty-space"></div>
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
    </section>
@endsection
