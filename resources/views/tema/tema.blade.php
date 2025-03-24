@extends('layouts.fo_layout')
<script src="{{ asset('js/tema.js') }}"></script>

@section('full_width_content')
    <div class="container-fluid">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('imagens/carousels1.png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('imagens/carousels2.png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('imagens/carousels3.png') }}" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isModerador()))
        <button id= "botaoSelecionar" class="botaoPrincipal rounded-pill px-3 mt-5" type="button">selecionar</button>
    @endif

    <form id="deleteForm" action="{{ route('tema.deleteMultiple') }}" method="POST">
        @method('DELETE')
        @csrf
        <div class="row mt-5">
            @foreach ($tema as $temas)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="row g-0 flex-grow-1">
                                <div class="form-check mb-3 tema-checkbox" style="display: none;">
                                    <input type="checkbox" class="form-check-input" id="tema_{{ $temas->id }}"
                                        name="temas[]" value="{{ $temas->id }}">
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/'. $temas->icons) }}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="fontePrincipal">{{ $temas->nome }}</h5>
                                    <p class="fontePrincipal">{{ $temas->descricao }}</p>
                                </div>
                            </div>
                            <div class="mt-auto text-center w-100">
                                <a href="{{ route('tema.material', $temas->id) }}"><button
                                        class="botaoPrincipal rounded-pill px-3" type="button">ir para o
                                        material</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="botaoDeletar" class="text-center mt-4 mb-4" style="display: none;">
                <button class="btn btn-danger rounded-pill px-3" type="submit">Excluir</button>
            </div>
    </form>

    @if (Auth::check() && Auth::user()->isAdmin())
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-dashed">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="text-center mb-3 flex-grow-1 d-flex flex-column justify-content-center">
                        <i class="fas fa-plus-circle fa-3x text-muted"></i>
                        <h5 class="fontePrincipal text-center mt-3">Adicionar Novo Tema</h5>
                    </div>
                    <div class="text-center w-100">
                        <a href="{{ route('tema.add') }}"><button class="botaoPrincipal rounded-pill px-3"
                                type="button">Adicionar</button></a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
@endsection
