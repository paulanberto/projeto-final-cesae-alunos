@extends('layouts.fo_layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/view&edituser.css') }}">
<link rel="stylesheet" href="{{ asset('css/addtema.css') }}">

<div class="container user-container ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title fonteBold">{{$user->name }}</h5>
                </div>
                <div class="card-body fontePrincipal">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="curso_id">Curso</label>
                            <select class="form-control" id="curso_id" name="curso_id">
                                <option value="">Sem Curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}"
                                            {{ old('curso_id', $user->curso_id) == $curso->id ? 'selected' : '' }}>
                                        {{ $curso->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="user_type">Ano de Inscrição</label>
                            <input type="user_type" class="form-control" id="user_type" name="user_type" value="{{ $user->ano }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="user_type">Tipo de utilizador</label>
                            <select class="form-control" id="user_type" name="user_type">
                                <option selected>Selecione o tipo de utilizador</option>
                                <option value="0">Aluno</option>
                                <option value="1">Moderador</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="saldo_pontos">Pontos</label>
                            <input type="number" class="form-control" id="saldo_pontos" name="saldo_pontos"
                                   value="{{ old('saldo_pontos', $user->saldo_pontos) }}" required min="0">
                        </div>


                        <button type="submit" class="btn botaoPrincipal">Guardar</button>
                        <a href="{{ route('users.view.single', $user->id) }}" class="btn botaoCancel">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
