@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Forum {{-- - {{$categoria}} --}}
@endsection


@section('content')


    <div class="container">
        <h1 class="fonteBold"> {{$categoria->nome}} </h1>
        <table class="table align-middle table-hover fontePrincipal">
            <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Por</th>
                <th scope="col">Data</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">

            @foreach ($posts as $post)

                <tr>
                    <th scope="row"> {{$post->titulo}} </th>
                    <td> @foreach ($post->tags as $tag)
                            <span class="tableTag fontePrincipal"> {{$tag->nome}} </span>
                        @endforeach
                    </td>

                    <td>
                    <span class="tablePostType">
                        @if ($post->post_type_id == 2)
                            pergunta
                        @else
                            discussão
                        @endif
                    </span>
                    </td>
                    <td> {{$post->user->name}} </td>
                    <td> {{$post->created_at}} </td>
                    <td> <a href="{{route('forum.show', $post->id)}}">
                        <button class="botaoPrincipal rounded-pill px-3">Ver</button>
                    </a> </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
