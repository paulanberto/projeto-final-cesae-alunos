@extends('layouts.fo_layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/material.css') }}">
    <script src="{{ asset('js/material.js') }}"></script>


    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fonteBold mt-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Bibendum amet at molestie mattis.</h1>
            {{-- @if (Auth::check() && Auth::user()->isAdmin()) lembrar do endif no final--}}
            <button id= "botaoSelecionar" class="botaoPrincipal rounded-pill px-3" type="button">selecionar</button>
    </div>

    <div class="cards-list mt-5">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="image-container">
                        <a href="{{ route('material.add') }}">
                            <button type="button" class="btn btn-outline">
                                <i class="fa fa-plus fa-3x"></i>
                            </button>
                        </a>
                    </div>
                    <div>
                        <h5 class="fonteBold">Adicionar Material</h5>
                    </div>
                </div>
                <a href="{{ route('material.add') }}" class="info-link d-flex align-items-center">
                    Add Material <span class="ms-2">→</span>
                </a>
            </div>
        </div>

        <form id="deleteForm" action="{{ route('material.deleteMultiple') }}" method="POST">
            @csrf
            @method('DELETE')

            @foreach ($material as $materiais)
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="form-check mb-3 material-checkbox" style="display: none;">
                                <input type="checkbox" class="form-check-input" id="material_{{ $materiais->id }}"
                                    name="materials[]" value="{{ $materiais->id }}">
                            </div>
                            <div class="image-container">
                                <img src="" alt="">
                            </div>
                            <div>
                                <h5 class="fonteBold">{{ $materiais->titulo }}</h5>
                                <p class="fontePrincipal">{{ $materiais->texto }}</p>
                            </div>
                        </div>
                        <a href="#" class="info-link d-flex align-items-center">
                            Mais Informação <span class="ms-2">→</span>
                        </a>
                    </div>
                </div>
            @endforeach

            <div id="botaoDeletar" class="text-center mt-4 mb-4" style="display: none;">
                <button class="btn btn-danger rounded-pill px-3" type="button">Excluir</button>
            </div>
        </form>
    </div>

@endsection
