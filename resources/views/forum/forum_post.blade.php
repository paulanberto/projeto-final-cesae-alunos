@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Forum - {{$post->titulo}}
@endsection


@section('content')

    <div class="container my-5 fontePrincipal col-lg-6">
        <div class="row">
            <div class="secaoPost col-11">
                <h3 class="fonteBold"> {{$post->titulo}} </h3>
                <p> {{$post->texto}} </p>
                <span class="postAutor">
                    por {{$post->user->name}}
                        @if ($post->user->curso)
                            ({{$post->user->curso->nome}} {{$post->user->curso->edicao}})
                        @endif
                         <br>
                        {{$post->created_at}}
                </span>
            </div>
            @if ((Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isModerador())) || Auth::user()->id == $post->user_id )
                <div class="col-1">
                    <form action="{{route('forum.delete', $post->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <p><button type="submit" class="btn btn-danger rounded-pill px-3">Excluir post</button></p>
                    </form>
                </div>
            @endif
        </div>


        <div class="secaoComentarios">
            @if ($post->children->isEmpty())
                <p> sem comentários</p>
            @else
                <h3>Comentários</h3>
                @foreach ($post->children as $comment)
                    <div class="row">
                        <div class="comentario col-11">
                            <h4> {{$comment->user->name}} </h4>
                            <p> {{$comment->texto}} </p>
                        </div>
                        @if ((Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isModerador()))|| Auth::user()->id == $post->user_id)
                            <div class="col-1">
                                <form action="{{route('forum.delete', $comment->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <p><button type="submit" class="btn btn-danger rounded-pill px-3">Excluir comentário</button></p>
                                </form>

                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
            <div>
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
