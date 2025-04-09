@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Fórum - editar Post
@endsection


@section('content')

<div class="col-12 col-lg-8">
    <h1 class="fonteBold forumTitle">Editar dúvida/discussão</h1>
    <div class="createPostForm">
        <form action="{{route('forum.update')}}" method="POST">
            @csrf
            <div class="row g-2 mb-3">
                <label for="inputTitulo" class="form-label fontePrincipal">Título</label>
                <div class="col-12 col-lg-7 align-self-start">
                    <input type="text" class="form-control" id="inputTitulo" name="titulo" value="{{$post->titulo}}">

                    @error('titulo')
                    <p style="color: red">Titulo inválido</p>
                    @enderror
                </div>
                <div class="col-8 col-lg-5 align-self-end">
                    <select class="form-select" aria-label="Default select example" id="selectPostType" name="post_type_id">
                        <option
                            @if ($post->post_type_id == 2)
                                selected
                            @endif
                        value="2">Dúvida</option>
                        <option
                            @if ($post->post_type_id == 3)
                                selected
                            @endif
                        value="3">Discussão</option>
                    </select>
                    @error('post_type_id')
                        Selecione um tipo de post
                    @enderror
                </div>
            </div>
            <div class="mb-3">
            <label for="inputTexto" class="form-label fontePrincipal">Conteúdo</label>
            <textarea rows="4" class="form-control" id="inputTexto" name="texto">{{$post->texto}}</textarea>
            @error('texto')
                <p style="color: red">Texto inválido</p>
            @enderror
            </div>

            <label for="tagChecks" class="fontePrincipal">Tags</label>
            <div class="tagChecks mb-3" id="tagChecks">

                @foreach ($allTags as $tag)
                    <input type="checkbox" class="btn-check" id="btn-check-{{$tag->id}}" autocomplete="off"
                        name="tags[]" value="{{$tag->id}}">
                    <label type="button" class="tagCheckButton btn fontePrincipal" {{-- data-bs-toggle="button" --}}
                        for="btn-check-{{$tag->id}}" id="tagButton-{{$tag->id}}"> {{$tag->nome}} </label>
                @endforeach
                @error('tag')
                    Selecione as tags aplicáveis ao post
                @enderror
            </div>
            <input hidden type="text" name="categoria_id" value="{{$post->categoria_id}}">
            <input hidden type="text" name="id" value="{{$post->id}}">
            <button type="submit" class="botaoPrincipal rounded-pill px-3">Submit</button>
        </form>
    </div>
</div>
@endsection
