@extends('layouts.fo_layout')
<link rel="stylesheet" href="{{asset('css/forum_style.css')}}">

@section('title')
    Forum - nova dúvida
@endsection


@section('content')

{{-- <h1>{{$id}}</h1> --}}

{{-- @foreach ($allTags as $tag)
    <h1> {{$tag->nome}} </h1>

@endforeach --}}

<div class="col-12 col-lg-8">
    <h1 class="fonteBold forumTitle">Nova dúvida/discussão</h1>
    <div class="createPostForm">
        <form>
            <div class="row g-2 mb-3">
                <label for="inputTitulo" class="form-label fontePrincipal">Título</label>
                <div class="col-12 col-lg-7 align-self-start">
                    <input type="text" class="form-control" id="inputTitulo" name="titulo">
                </div>
                <div class="col-8 col-lg-5 align-self-end">
                    <select class="form-select" aria-label="Default select example" id="selectPostType" name="post_type_id">
                        <option selected value="2">Dúvida</option>
                        <option value="3">Discussão</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
            <label for="inputTexto" class="form-label fontePrincipal">Conteúdo</label>
            <textarea rows="4" class="form-control" id="inputTexto" name="texto"></textarea>
            </div>

            <label for="tagChecks" class="fontePrincipal">Tags</label>
            <div class="tagChecks mb-3" id="tagChecks">

                @foreach ($allTags as $tag)
                    <input type="checkbox" class="btn-check" id="btn-check-{{$tag->id}}" autocomplete="off">
                    <label type="button" class="tagCheckButton btn btn-primary fontePrincipal" data-bs-toggle="button"
                        for="btn-check-{{$tag->id}}"> {{$tag->nome}} </label>
                @endforeach
            </div>
            <button type="submit" class="botaoPrincipal rounded-pill px-3">Submit</button>
        </form>
    </div>
</div>
@endsection
