@extends('layouts.fo_layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('css/addtema.css') }}">

    @if(session('points_message'))
        <div class="alert alert-info">
            {{ session('points_message') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mt-5">
        <div class="card rounded-3 p-4">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h2 class="fonteBold">{{ $post->titulo }}</h2>
                <a href="{{ route('material.show', ['id' => $post->categoria_id]) }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i> Voltar
                </a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="material-preview mb-4">
                        @if($fileType === 'image')
                            <img src="{{ asset('storage/' . $post->ficheiro) }}" class="img-fluid rounded" alt="{{ $post->titulo }}">
                        @elseif($fileType === 'video')
                            <video controls class="w-100 rounded">
                                <source src="{{ asset('storage/' . $post->ficheiro) }}" type="video/{{ pathinfo($post->ficheiro, PATHINFO_EXTENSION) }}">
                                Seu navegador não suporta a reprodução de vídeos.
                            </video>
                        @elseif($fileType === 'document')
                            <div class="document-preview p-4 border rounded bg-light text-center">
                                <i class="fa-solid fa-file-lines fa-5x mb-3"></i>
                                <p>Documento: {{ basename($post->ficheiro) }}</p>
                                <a href="{{ asset('storage/' . $post->ficheiro) }}" class="btn btn-primary" target="_blank">Abrir Documento</a>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                Tipo de arquivo não reconhecido.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header fonteBold">
                            Informações do Material
                        </div>
                        <div class="card-body">
                            <p><strong>Categoria:</strong> {{ $post->categoria->nome}}</p>
                            <p><strong>Enviado por:</strong> {{ $post->user->name }}</p>
                            <p><strong>Data de criação:</strong> {{ date('d/m/Y H:i', strtotime($post->created_at)) }}</p>

                            <hr>

                            <h5 class="fonteBold">Descrição</h5>
                            <p>{{ $post->texto }}</p>

                            <div class="secaoComentarios">
                                @if ($post->children->isEmpty())
                                    <p> sem comentários</p>
                                @else
                                    @foreach ($post->children as $comment)
                                        <div class="comentario">
                                            <h4> {{$comment->user->name}} </h4>
                                            <p> {{$comment->texto}} </p>
                                        </div>
                                    @endforeach
                                @endif
                                <div>
                                    <form action="{{route('forum.comment')}}" method="POST">
                                        @csrf
                                        <p>Junte-se à discussão</p>
                                        <input type="text" name="texto">
                                        <input type="hidden" name="parent_id" value="{{$post->id}}">
                                        <input type="hidden" name="categoria_id" value="{{$post->categoria_id}}">
                                        <input type="hidden" name="parent_type_id" value="{{$post->post_type_id}}">
                                        <input type="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
