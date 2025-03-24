@extends('layouts.fo_layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"></h5>
                    <a href="{{ route('users.view') }}" class="btn btn-secondary">Voltar</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        {{-- <tr>
                            <th>ID:</th>
                            <td>{{ $user->id }}</td>
                        </tr> --}}
                        <tr>
                            <th>Nome</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Curso</th>
                            <td>
                                @if(isset($user->curso_id) && $user->curso_id)
                                    {{ $user->curso_nome ?? $user->curso_id }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Data de criação</th>
                            <td>{{ $user->created_at ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        @auth
                            @if(Auth::user()->user_type === 1 || Auth::user()->user_type === 2)
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Alterar</a>
                            @endif

                            @if(Auth::user()->user_type === 1)
                                <a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger"
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