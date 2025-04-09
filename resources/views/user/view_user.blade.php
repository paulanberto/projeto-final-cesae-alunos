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
                    <h5 class="fonteBold">{{ $user->name }}</h5>

                </div>
                <div class="card-body fontePrincipal ">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th >Curso</th>
                            <td >
                                @if(isset($user->curso_id) && $user->curso_id)
                                    {{ $user->curso_nome ?? $user->curso_id }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th >Data de criação</th>
                            <td >{{ $user->created_at ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th >Saldo de Pontos</th>
                            <td >{{ $user->saldo_pontos}}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        @auth
                            @if(Auth::user()->user_type === 1 || Auth::user()->user_type === 2)
                                <a href="{{ route('users.edit', $user->id) }}" class="  botaoPrincipal btn">Alterar</a>
                            @endif

                            <a href="{{ route('users.view') }}" class="botaoCancel  btn btn-secondary">Voltar</a>

                            @if(Auth::user()->user_type === 1)
                                <a  href="{{ route('users.delete', $user->id) }}" class=" btn btn-danger"
                                   onclick="return confirm('Te a certeza qe qur apagar este utilizador?')">Apagar</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection