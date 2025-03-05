@extends('layouts.fo_layout')
@section('content')
    {{-- <img src="{{ asset('imagens/imageteste.png') }}" class="img-fluid" alt="..."> --}}
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('imagens/Design sem nome (2).png') }}" class="d-block w-90" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('imagens/imagemtemas.jpg')}}" class="d-block w-50" alt="...">
            </div>
            {{-- <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div> --}}
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="..." class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="fontePrincipal">Card title</h5>
                    <p class="fontePrincipal">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                    <p class="fontePrincipal"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    <button class="botaoPrincipal rounded-pill px-3" type="button">ir para o material</button>
                </div>
            </div>
        </div>
    </div>
@endsection
