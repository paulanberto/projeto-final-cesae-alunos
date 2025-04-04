@extends('layouts.fo_layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="fonteBold">{{ $user->name }}</h5>

                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th class="fonteBold">Email</th>
                            <td class="fontePrincipal" >{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="fonteBold">Curso</th>
                            <td class="fontePrincipal">
                                @if(isset($user->curso_id) && $user->curso_id)
                                    {{ $user->curso_nome ?? $user->curso_id }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="fonteBold">Data de criação</th>
                            <td class="fontePrincipal">{{ $user->created_at ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="fonteBold">Saldo de Pontos</th>
                            <td class="fontePrincipal">{{ $user->saldo_pontos}}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        @auth
                            @if(Auth::user()->user_type === 1 || Auth::user()->user_type === 2)
                                <a href="{{ route('users.edit', $user->id) }}" class=" fontePrincipal btn btn-warning">Alterar</a>
                            @endif

                            <a href="{{ route('users.view') }}" class=" fontePrincipal btn btn-secondary">Voltar</a>

                            @if(Auth::user()->user_type === 1)
                                <a  href="{{ route('users.delete', $user->id) }}" class=" fontePrincipal btn btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this user?')">Apagar</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection