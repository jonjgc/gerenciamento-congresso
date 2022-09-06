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
        <h1>Criar Universidade</h1>
        <hr>
        <form action="{{ route('criar-universidade') }}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <label for="name">Nome:</label>
                    <input class="form-control" type="text" name="nome" id="name">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="sigla">Sigla:</label>
                    <input class="form-control" type="text" name="sigla" id="sigla">
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" type="submit">Criar</button>
            </div>
        </form>
    </div>
@endsection
