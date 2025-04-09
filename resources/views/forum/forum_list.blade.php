@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Fórum {{-- - {{$categoria}} --}}
@endsection


@section('content')


    <div class="container">
        <h1 class="fonteBold forumTitle"> {{$categoria->nome}} </h1>

        <a href="{{route('forum.create', $categoria->id)}}" class="newPostButton">
            <div class="card newPostCard mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="image-container">
                                <button type="button" class="btn btn-outline">
                                    <i class="fa fa-plus fa-2x"></i>
                                </button>
                        </div>
                        <div>
                            <h5 class="fonteBold newPostButtonText">Nova dúvida ou discussão</h5>
                        </div>
                    </div>
                </div>
            </div>
        </a>

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
        <section>
            <div id="pagination-nav"  aria-label="Page navigation">
                <ul class="pagination">


                    <li class="page-item @if ($posts->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $posts->previousPageUrl() }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    @for ($i = 1; $i <= $posts->lastPage(); $i++)
                        <li class="page-item {{ ($posts->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="page-item @if (!$posts->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{ $posts->nextPageUrl() }}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </div>

@endsection
