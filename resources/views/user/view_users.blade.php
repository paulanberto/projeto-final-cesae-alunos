@extends('layouts.fo_layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/viewusers.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">



    <section class="table-section">
        <div class="table-title d-flex justify-content-between align-items-center mb-4">
            <h2 class="m-0 fontePrincipal">Area Utilizadores</h2>
            <form class="search-form d-flex">
                <div class="input-group">
                    <input type="text" class="form-control search-input" name="search" placeholder="Pesquisar utilizadores..." value="{{ request()->query('search') }}">
                    <button type="submit" class="btn btn-primary search-button">
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover ">
                <thead class="fonteBold">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Curso</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="fontePrincipal">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (isset($user->curso_id) && $user->curso_id)
                                    {{ $user->curso_nome ?? $user->curso_id }}
                                @elseif(Auth::user()->user_type === 1)
                                    ND
                                @else
                                    ND
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.view.single', $user->id) }}" class="botaoPrincipal rounded-pill px-3">ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <section>
                <div id="pagination-nav"  aria-label="Page navigation">
                    <ul class="pagination">

                        @if ($users->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}">Anterior</a></li>
                        @endif


                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <li class="page-item {{ ($users->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($users->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}">Próximo</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        @endif
                    </ul>
                </div>
            </section>
        </div>
    </section>
@endsection
