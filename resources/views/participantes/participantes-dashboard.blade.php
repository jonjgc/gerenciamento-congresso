@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <li>{{ session('message') }}</li>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <h3>Trabalhos Enviados</h3>
                        <div class="mb-2 d-flex justify-content-center">
                            @if ($trabalho)
                                <div class="border rounded border-warning p-3 row">
                                    <div class=" col-md-6">
                                        <label for="">Titulo: </label>
                                        <p class="fw-bold">{{ $trabalho->titulo }}</p>
                                    </div>
                                    <div class=" col-md-6">
                                        <label for="">Autor: </label>
                                        <p class="fw-bold">{{ $trabalho->autor }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Arquivo: </label>
                                        <p class="fw-bold">{{ $trabalho->nome_original }}</p>
                                    </div>
                                    @if (is_null($trabalho->nota))
                                        <div class="col-md-6 d-flex align-items-center">
                                            <a class="btn btn-warning"
                                                href="{{ route('editar-trabalho-view', $trabalho->id) }}">Editar
                                                Trabalho</a>
                                        </div>
                                    @else
                                        <div class="col-md-6 d">
                                            <label for="">Nota: </label>
                                            <p class="fw-bold">{{ $trabalho->nota }}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <a class="btn btn-info" href="{{ route('enviar-trabalho-view') }}">Enviar Trabalho</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
