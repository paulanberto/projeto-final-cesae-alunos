@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Forum {{-- - {{$post->titulo}} --}}
@endsection


@section('content')
    {{-- {{dd($post->children)}} --}}

    <div class="container my-5 fontePrincipal col-lg-6">
        <h3 class="fonteBold"> {{$post->titulo}} </h3>
        <p> {{$post->texto}} </p>
        <span class="postAutor">
            por {{$post->user->name}} ({{$post->user->curso->nome}} {{$post->user->curso->edicao}}) <br>
                {{$post->created_at}}
        </span>

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

@endsection
