@extends('layouts.app')

@section('titulo', 'Admin Dashboard')

@section('content')
    <div class="container card px-3 py-2">
        <h1>Dashboard Admin</h1>
        <hr>
        <div class="row gap-2">
            <div class="col-md">
                <a class="btn btn-primary" href="{{ route('gerenciar-usuarios') }}">Gerenciar usuários</a>
            </div>
            <div class="col-md">
                <a class="btn btn-success" href="{{ route('home') }}">Listar Trabalhos</a>
            </div>
            <div class="col-md">
                <a class="btn btn-success" href="{{ route('gerenciar-universidades') }}">Gerenciar Universidades</a>
            </div>

        </div>
    </div>
@endsection
