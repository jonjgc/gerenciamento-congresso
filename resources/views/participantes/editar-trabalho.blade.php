@extends('layouts.app')

@section('titulo', 'Editar Trabalho')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar Trabalho</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('editar-trabalho', $trabalho->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row g-1">
                                <div class="col-md-6">
                                    <label class="form-label" for="titulo">Titulo do Trabalho:</label>
                                    <input class="form-control" type="text" name="titulo" id="titulo"
                                        value="{{ $trabalho->titulo }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="autor">Autor do Trabalho(Nome Completo):</label>
                                    <input class="form-control" type="text" name="autor" id="autor"
                                        value="{{ $trabalho->autor }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="autor">Upload do Arquivo(PDF):</label>
                                    <a class='btn btn-primary' onclick="uploadFile()">
                                        <i class="fa-solid fa-upload me-1"></i>
                                        Arquivo
                                        <input id='upload-file' type='file' value="{{ $trabalho->nome_original }}"
                                            name="anexo" hidden onchange="nomeArquivo()" />
                                    </a>
                                    <div class="">
                                        <span class="text-danger" id='file-name'>{{ $trabalho->nome_original }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button class="btn btn-info" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function uploadFile() {
            document.getElementById('upload-file').click();
        }

        function nomeArquivo() {
            var fileField = document.getElementById('upload-file');
            var name = fileField.files[0].name;
            document.getElementById('file-name').innerHTML = name;
        }
    </script>
@endsection
