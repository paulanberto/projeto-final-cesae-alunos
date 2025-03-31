@extends('layouts.fo_layout')
@section('full_width_content')

<link rel="stylesheet" href="{{ asset('css/addtema.css') }}">

    <div class="container mt-5">
        <div class="card rounded-3 p-4 mx-auto" style="max-width: 400px;">
            <h4 class="fonteBold">Adicionar Tema</h4>

            <form action="{{ route('tema.create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="fontePrincipal">Escolher uma Imagem</label>
                    <div class="d-flex align-items-center gap-2">
                        <div class="border rounded d-flex align-items-center justify-content-center"
                            style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-image"></i>
                        </div>
                        <label class="btn btn-light border rounded-3 d-flex align-items-center justify-content-center m-0"
                            style="width: 48px; height: 48px;">
                            <input type="file" name="icons" class="d-none">
                            <i class="fa fa-plus"></i>
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sectionTitle" class="fontePrincipal">Título do Tema</label>
                    <input type="text" class="form-control" id="sectionTitle" name="nome"
                        placeholder="Insira o Título...">
                </div>

                <div class="mb-4">
                    <label for="sectionDescription" class="fontePrincipal">Descrição do Tema</label>
                    <textarea class="form-control" id="sectionDescription" name="descricao" rows="3"
                        placeholder="Adicione a descrição aqui..."></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('tema') }}"><button type="button" class="botaoCancel" data-bs-dismiss="modal">Cancel</button></a>
                    <button class="botaoPrincipal rounded-pill px-3" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
