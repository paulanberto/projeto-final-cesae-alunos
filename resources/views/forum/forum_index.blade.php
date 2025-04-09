@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Fórum
@endsection
{{-- {{dd($categorias)}} --}}
@section('content')
    <div class="forumTitle">
        <h1 class="fonteBold">Fórum Cesae Alunos</h1>
    </div>

    @foreach ($categorias as $categoria )
        <div class="container categoriaCard">
            <div class="row">
                <div class="col-8">
                    <h3 class="fonteBold"> {{$categoria->nome}} </h3>
                    <p class="fontePrincipal"> {{$categoria->descricao}} </p>
                </div>
                <div class="col-4" id="categoriaLink">
                    <a class="fonteBold" href=" {{route('forum.list', $categoria->id)}} ">Junte-se à conversa</a>
                </div>
            </div>
        </div>
    @endforeach

@endsection
