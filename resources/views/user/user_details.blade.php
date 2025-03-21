@extends('layouts.fo_layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User Details</h5>
                    <a href="{{ route('users.view') }}" class="btn btn-secondary">Back to Users List</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- View Mode -->
                    <div id="viewMode" class="{{ isset($editMode) && $editMode ? 'd-none' : '' }}">
                        <table class="table">
                            <tr>
                                <th>ID:</th>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Course:</th>
                                <td>
                                    @if(isset($user->curso_id) && $user->curso_id)
                                        {{ $user->curso_nome ?? $user->curso_id }}
                                    @else
                                        No course
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Account Created:</th>
                                <td>{{ $user->created_at ?? 'Not available' }}</td>
                            </tr>
                        </table>

                        <div class="mt-4">
                            @auth
                                @if(Auth::user()->user_type === 1 || Auth::user()->user_type === 2)
                                    <a href="{{ route('users.view.single', ['id' => $user->id, 'edit' => true]) }}" class="btn btn-warning">Edit</a>
                                @endif

                                @if(Auth::user()->user_type === 1)
                                    <a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <!-- Edit Mode -->
                    <div id="editMode" class="{{ isset($editMode) && $editMode ? '' : 'd-none' }}">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="curso_id">Course</label>
                                <select class="form-control" id="curso_id" name="curso_id">
                                    <option value="">No Course</option>
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}"
                                                {{ old('curso_id', $user->curso_id) == $curso->id ? 'selected' : '' }}>
                                            {{ $curso->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update User</button>
                            <a href="{{ route('users.view.single', $user->id) }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection