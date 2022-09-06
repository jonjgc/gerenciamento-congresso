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
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <li>{{ session('message') }}</li>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h1>Gerenciar Universidades</h1>
            <a class="btn btn-primary" href="{{ route('criar-universidade') }}"> Criar Universidade</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ativo</th>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($universidades as $universidade)
                        <tr>
                            <td>{{ $universidade->id }}</td>
                            <td class="{{ $universidade->ativo ? 'table-success' : 'table-danger' }}">
                                {{ $universidade->ativo ? 'Ativo' : 'Inativo' }}</td>
                            <td>{{ $universidade->nome }}</td>
                            <td>{{ $universidade->sigla }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <form action="{{ route('ativar-universidade', $universidade->id) }}" method="post">
                                    @csrf
                                    <button class="btn {{ $universidade->ativo ? ' btn-danger' : 'btn-success' }}"
                                        type="submit">
                                        {{ $universidade->ativo ? 'Desativar' : 'Ativar' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $universidades->links() }}
        </div>
    </div>
@endsection
