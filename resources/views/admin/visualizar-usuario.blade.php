@extends('layouts.app')

@section('titulo', 'Admin Dashboard')

@section('content')
    <div class="container card px-3 py-2">
        <div class="d-flex justify-content-between">
            <h1>Visualizar Usuário - {{ $user->id }}</h1>
            <a class="btn btn-warning" href="{{ route('editar-usuario', $user->id) }}">Editar</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label for="name">Name:</label>
                <p class="border-bottom border-2 border-info" id="name">{{ $user->name }}</p>
            </div>
            <div class="col-md-6">
                <label for="email">Email:</label>
                <p class="border-bottom border-2 border-info" id="email">{{ $user->email }}</p>
            </div>
            <div class="col-md-3">
                <label for="type">Tipo de Usuário:</label>
                <p class="border-bottom border-2 border-info" id="type">
                    {{ \App\Models\Role::NAMES[$user->role_id] }}
                </p>
            </div>
            <div class="col-md-3">
                <label for="created_at">Data de Cadastro:</label>
                <p class="border-bottom border-2 border-info" id="created_at">
                    {{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y \à\s H:i\h') }}</p>
            </div>
            <div class="col-md-3">
                <label for="updated_at">Ultima Atualização:</label>
                <p class="border-bottom border-2 border-info" id="updated_at">
                    {{ Carbon\Carbon::parse($user->updated_at)->format('d/m/Y \à\s H:i\h') }}</p>
            </div>
        </div>
    </div>
@endsection
