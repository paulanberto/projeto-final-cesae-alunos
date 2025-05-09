@extends('layouts.fo_layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/material.css') }}">
    <script src="{{ asset('js/material.js') }}"></script>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session('points_message'))
        <div class="alert alert-info">
            {{ session('points_message') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <hr>
        @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isModerador()))
            <button id= "botaoSelecionar" class="botaoPrincipal rounded-pill px-3 mt-5" type="button">selecionar</button>
        @endif
    </div>
    <h1 class="fonteBold mt-5">{{ $categoria->nome ?? 'Materiais' }}</h1>

    <div class="cards-list mt-5">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="image-container">
                        <a href="{{ route('material.add', ['categoria_id' => $categoria->id]) }}">
                            <button type="button" class="btn btn-outline">
                                <i class="fa fa-plus fa-3x"></i>
                            </button>
                        </a>
                    </div>
                    <div>
                        <h5 class="fonteBold">Adicionar Material</h5>
                    </div>
                </div>
            </div>
        </div>

        <form id="deleteForm" action="{{ route('material.deleteMultiple') }}" method="POST">
            @method('DELETE')
            @csrf
            <input hidden type="text" name="categoria_id" value="{{ $categoria->id }}">
            @foreach ($material as $materiais)
                @if ($materiais->post_type_id == 1)
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="form-check mb-3 material-checkbox" style="display: none;">
                                    <input type="checkbox" class="form-check-input" id="material_{{ $materiais->id }}"
                                        name="materiais[]" value="{{ $materiais->id }}">
                                </div>
                                <div>
                                    <h5 class="fonteBold">{{ $materiais->titulo }}</h5>
                                    <p class="fontePrincipal">{{ Str::limit($materiais->texto, 70) }}</p>
                                </div>
                            </div>
                            <a href="{{ route('material.detalhes', ['id' => $materiais->id]) }}"
                                class="info-link d-flex align-items-center fontePrincipal">
                                Mais Informação <span class="ms-2">→</span>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach

            <div id="botaoDeletar" class="text-center mt-4 mb-4" style="display: none;">
                <button class="btn btn-danger rounded-pill px-3" type="submit">Excluir</button>
            </div>
        </form>
    </div>
@endsection
