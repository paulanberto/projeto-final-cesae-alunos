@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Forum - {{$post->titulo}}
@endsection


@section('content')

    <div class="container my-5 fontePrincipal col-12 col-lg-10">
        <div class="row my-3">
            <div class="col-11"></div>
            <div class="col-1 align-self-end">
                <a href="{{route('forum.list', $post->categoria_id)}}"><button class="botaoPrincipal rounded-pill px-3">
                    Voltar
                </button></a>
            </div>
        </div>
        <div class="row">
            <div class="secaoPost col-12 px-5">
                <h3 class="fonteBold"> {{$post->titulo}} </h3>
                <p> {{$post->texto}} </p>
                <span class="postAutor">
                    por {{$post->user->name}}
                        @if ($post->user->curso)
                            ({{$post->user->curso->nome}} {{$post->user->ano}})
                        @endif
                         <br>
                        {{$post->created_at}}
                </span>
            </div>
            <div class="row mt-3">

                <div class="col">

                            @if (Auth::check() && (Auth::user()->id == $post->user_id))
                                <a href="{{route('forum.edit', $post->id)}}"><button class="btn btn-warning rounded-pill px-3">Editar</button></a>
                            @endif
                            @if ((Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isModerador())) || Auth::user()->id == $post->user_id )
                                <form action="{{route('forum.delete', $post->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <p><button type="submit" class="btn btn-danger rounded-pill px-3">Excluir post</button></p>
                                </form>
                            @endif

                </div>
            </div>

        </div>


        <div class="secaoComentarios">
            @if ($post->children->isEmpty())
                <p> sem comentários</p>
            @else
                <h3>Comentários</h3>
                @foreach ($post->children as $comment)
                    <div class="row comentarioRow">
                        <div class="comentario col-12 px-5">
                            <h4> {{$comment->user->name}}  <span>
                                @if ($comment->user->curso)
                                    ({{$comment->user->curso->nome}} {{$comment->user->ano}})
                                @endif</span> </h4>
                            <p> {{$comment->texto}} </p>
                        </div>
                        @if ((Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isModerador()))|| Auth::user()->id == $post->user_id)
                            <div class="row">
                                <div class="col-4 justify-self-end mt-3">
                                    <form action="{{route('forum.delete', $comment->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <p><button type="submit" class="btn btn-danger rounded-pill px-3">Excluir comentário</button></p>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
            <div class="comentarioForm">
                <form action="{{route('forum.comment')}}" method="POST">
                    @csrf
                    <p>Junte-se à discussão</p>
                    <textarea class="form-control commentInput" name="texto" rows="3"
                        placeholder="Seu comentário aqui"></textarea>
                    <input type="hidden" name="parent_id" value="{{$post->id}}">
                    <input type="hidden" name="categoria_id" value="{{$post->categoria_id}}">
                    <input type="hidden" name="parent_type_id" value="{{$post->post_type_id}}">
                    <input type="submit" class="botaoPrincipal rounded-pill px-3">
                </form>
            </div>
        </div>

    </div>

@endsection
