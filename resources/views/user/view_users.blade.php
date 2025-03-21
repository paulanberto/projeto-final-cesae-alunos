@extends('layouts.fo_layout')
@section('content')

<section class="table-section">
    <div>
        <h2 class="table-title">All Users</h2>
        <form>
            <input type="text" id="" name="search" value="{{ request()->query('search') }}">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>
    <table class="table-section">
        <thead>
            <tr>
                <th scope="col">Placeholder</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Course</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(isset($user->curso_id) && $user->curso_id)
                            {{ $user->curso_nome ?? $user->curso_id }}
                        @else
                            No course
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('users.view.single', $user->id) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

@endsection