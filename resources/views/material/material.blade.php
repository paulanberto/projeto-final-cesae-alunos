@extends('layouts.fo_layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/material.css') }}">
    <h1 class="fonteBold mt-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Bibendum amet at molestie mattis.</h1>
        <div class="cards-list mt-5">
            {{-- @if (Auth::check() && Auth::user()->isAdmin()) --}}
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="image-container" >
                            <a href="{{route('material.add')}}">
                                <button type="button" class="btn btn-outline">
                                    <i class="fa fa-plus fa-3x"></i>
                                </button>
                            </a>
                        </div>
                        <div>
                            <h5 class="fonteBold">Adicionar Material</h5>
                        </div>
                    </div>
                    <a href="{{route('material.add')}}" class="info-link d-flex align-items-center">
                        Add Material <span class="ms-2">→</span>
                    </a>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="image-container">
                            <img src="" alt="">
                        </div>
                        <div>
                            <h5 class="fonteBold">Título do Material</h5>
                            <p class="fontePrincipal">Descrição....</p>
                        </div>
                    </div>
                    <a href="#" class="info-link d-flex align-items-center">
                        Mais Informação <span class="ms-2">→</span>
                    </a>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="image-container" >
                            <img src="" alt="">
                        </div>
                        <div>
                            <h5 class="fonteBold">Título do Material</h5>
                            <p class="fontePrincipal">Descrição....</p>
                        </div>
                    </div>
                    <a href="#" class="info-link d-flex align-items-center">
                        Mais Informação <span class="ms-2">→</span>
                    </a>
                </div>
            </div>
        </div>
@endsection
