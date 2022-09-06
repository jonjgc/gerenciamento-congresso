@extends('layouts.app')

@section('titulo', 'Admin Dashboard')

@section('content')
    <div class="container card px-3 py-2">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h1>Editar Usuário - {{ $user->id }}</h1>
            <form action="{{ route('deletar-usuario', $user->id) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">Deletar</button>
            </form>
        </div>
        <hr>
        <form action="{{ route('atualizar-usuario', $user->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <label for="name">Name:</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email">Email:</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}">
                </div>
                <div class="col-md-3">
                    <label for="role_id">Tipo de Usuário:</label>
                    <select class="form-select" name="role_id" id="role_id">
                        @foreach (\App\Models\Role::NAMES as $roleId => $role)
                            <option value="{{ $roleId }}" @if ($user->role_id == $roleId) selected @endif>
                                {{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-warning" type="submit">Editar</button>
            </div>
        </form>
    </div>
@endsection
