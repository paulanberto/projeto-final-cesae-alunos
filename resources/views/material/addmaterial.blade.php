@extends('layouts.fo_layout')
@section('full_width_content')
    <link rel="stylesheet" href="{{ asset('css/addmaterial.css') }}">
    <script src="{{ asset('js/addmaterial.js') }}"></script>

    <div class="container mt-5">
        <div class="card shadow-sm rounded-3 p-4 mx-auto" style="max-width: 400px;">
            <h4 class="fonteBold">Adicionar Material</h4>

            <form action="{{ route('material.create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="categoria_id" value="{{ $categoriaId }}">

                <div class="mb-3">
                    <label for="categoriaTitle" class="fontePrincipal">Tema</label>
                    <input type="text" class="form-control" id="categoriaTitle" value="{{ $categoria->nome ?? '' }}"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="sectionTitle" class="fontePrincipal">Título do material</label>
                    <input type="text" class="form-control" id="sectionTitle" name="titulo"
                        placeholder="Insira o Título...">
                </div>
                <div class="mb-3">
                    <label class="fontePrincipal">Escolher o tipo de Material</label>
                    <div class="file-upload-area">


                        <input type="file" name="ficheiro" id="ficheiro" class="d-none" required>
                        <input type="hidden" id="selected-file-type" name="file_type" value="document">


                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="border rounded d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                            <div id="document-selector" class="file-type-selector active">
                                <button type="button"
                                    class="btn btn-light border rounded-3 d-flex align-items-center justify-content-center m-0"
                                    style="width: 48px; height: 48px;" onclick="selectAndUpload('document')">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>


                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="border rounded d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-image"></i>
                            </div>
                            <div id="image-selector" class="file-type-selector">
                                <button type="button"
                                    class="btn btn-light border rounded-3 d-flex align-items-center justify-content-center m-0"
                                    style="width: 48px; height: 48px;" onclick="selectAndUpload('image')">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>


                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="border rounded d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-video"></i>
                            </div>
                            <div id="video-selector" class="file-type-selector">
                                <button type="button"
                                    class="btn btn-light border rounded-3 d-flex align-items-center justify-content-center m-0"
                                    style="width: 48px; height: 48px;" onclick="selectAndUpload('video')">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="file-feedback-area" class="mt-3 text-center d-none">
                        <div class="alert alert-success">
                            <i class="fa fa-check-circle me-2"></i>
                            <span id="file-name-display"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="sectionDescription" class="fontePrincipal">Descrição do Material</label>
                    <textarea class="form-control" id="sectionDescription" name="texto" rows="3"
                        placeholder="Adicione a descrição aqui..."></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('material.show', ['id' => $categoriaId]) }}"><button type="button"
                            class="botaoCancel" data-bs-dismiss="modal">Cancel</button> </a>
                    <button class="botaoPrincipal rounded-pill px-3" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
