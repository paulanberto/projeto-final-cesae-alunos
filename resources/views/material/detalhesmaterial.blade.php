@extends('layouts.fo_layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/material.css') }}">

    <div class="container mt-5">
        <div class="card shadow-sm rounded-3 p-4">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h2 class="fonteBold">{{ $material->titulo }}</h2>
                <a href="{{ route('material.show', ['id' => $material->categoria_id]) }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i> Voltar
                </a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="material-preview mb-4">
                        @if(strpos($material->tipo_nome, 'Imagem') !== false)
                            <img src="{{ asset('storage/' . $material->ficheiro) }}" class="img-fluid rounded" alt="{{ $material->titulo }}">
                        @elseif(strpos($material->tipo_nome, 'Video') !== false)
                            <video controls class="w-100 rounded">
                                <source src="{{ asset('storage/' . $material->ficheiro) }}" type="video/mp4">
                                Seu navegador não suporta a reprodução de vídeos.
                            </video>
                        @else
                            <div class="document-preview p-4 border rounded bg-light text-center">
                                <i class="fa-solid fa-file-lines fa-5x mb-3"></i>
                                <p>Documento: {{ basename($material->ficheiro) }}</p>
                                <a href="{{ asset('storage/' . $material->ficheiro) }}" class="btn btn-primary" target="_blank">
                                    <i class="fa fa-download"></i> Download
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header fonteBold">
                            Informações do Material
                        </div>
                        <div class="card-body">
                            <p><strong>Categoria:</strong> {{ $material->categoria_nome }}</p>
                            <p><strong>Tipo:</strong> {{ $material->tipo_nome }}</p>
                            <p><strong>Enviado por:</strong> {{ $material->user_name }}</p>
                            <p><strong>Data de criação:</strong> {{ date('d/m/Y H:i', strtotime($material->created_at)) }}</p>

                            <hr>

                            <h5 class="fonteBold">Descrição</h5>
                            <p>{{ $material->texto }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection