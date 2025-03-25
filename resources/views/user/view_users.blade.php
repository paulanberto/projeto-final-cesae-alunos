@extends('layouts.fo_layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/viewusers.css') }}">
    <section class="table-section">
        <div class="table-title">
            <h2>Area Utilizadores</h2>
            <form>
                <input type="text" id="" name="search" value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-secondary">Search</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Curso</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
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
                                <a href="{{ route('users.view.single', $user->id) }}" class="btn btn-primary rounded-pill px-3">ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <section class="merda">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                  </nav>
            </section>


        </div>
    </section>
@endsection
