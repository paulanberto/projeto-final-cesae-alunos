@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Forum
@endsection
{{-- {{dd($categorias)}} --}}
@section('content')
    <div style="margin-bottom: 2rem">
        <h1 class="fontePrincipal">Forum Cesae Alunos</h1>
    </div>

    @foreach ($categorias as $categoria )
        <div class="container categoriaCard">
            <div class="row">
                <div class="col-8">
                    <h3 class="fonteBold"> {{$categoria->nome}} </h3>
                    <p class="fontePrincipal"> {{$categoria->descricao}} </p>
                </div>
                <div class="col-4" id="categoriaLink">
                    <a class="fonteBold" href="#">Junte-se à conversa</a>
                </div>
            </div>
        </div>
    @endforeach

@endsection
