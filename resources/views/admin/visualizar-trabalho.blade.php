@extends('layouts.app')

@section('titulo', 'Visualizar Trabalho')

@section('content')
    <div class="container card px-3 py-2">
        <div class="d-flex justify-content-between">
            <h1>Visualizar Trabalho - {{ $trabalho->id }}</h1>
            @if (auth()->user()->role_id == \App\Models\Role::ADMIN)
                <a class="btn btn-warning" href="{{ route('visualizar-usuario', $trabalho->user->id) }}">Visualizar
                    Usuário</a>
            @endif
        </div>
        <hr>

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
        <div class="row">
            <div class="col-md-6">
                <label class="fw-bold" for="name">Titulo:</label>
                <p class="border-bottom border-2 border-info" id="name">{{ $trabalho->titulo }}</p>
            </div>
            <div class="col-md-6">
                <label class="fw-bold" for="email">Autor:</label>
                <p class="border-bottom border-2 border-info" id="email">{{ $trabalho->autor }}</p>
            </div>
            <div class="col-md-3">
                <label class="fw-bold" for="type">Arquivo:</label>
                <p class="border-bottom border-2 border-info" id="type">
                    <a href="{{ $trabalho->getUrl() }}" target="_blank">{{ $trabalho->nome_original }}</a>
                </p>
            </div>

            <div class="col-md-3">
                <label class="fw-bold" for="type">Nota:</label>
                <p class="border-bottom border-2 border-info" id="type">
                    {{ is_null($trabalho->nota) ? 'Não Avaliado' : $trabalho->nota }}
                </p>
            </div>
            @if (auth()->user()->role_id == \App\Models\Role::ADMIN)
                <div class="col-md-3">
                    <label class="fw-bold" for="type">Username:</label>
                    <p class="border-bottom border-2 border-info" id="type">
                        {{ $trabalho->user->name }}
                    </p>
                </div>
            @endif
            <div class="col-md-3">
                <label class="fw-bold" for="created_at">Data de Cadastro:</label>
                <p class="border-bottom border-2 border-info" id="created_at">
                    {{ Carbon\Carbon::parse($trabalho->created_at)->format('d/m/Y \à\s H:i\h') }}</p>
            </div>
            <div class="col-md-3">
                <label class="fw-bold" for="updated_at">Ultima Atualização:</label>
                <p class="border-bottom border-2 border-info" id="updated_at">
                    {{ Carbon\Carbon::parse($trabalho->updated_at)->format('d/m/Y \à\s H:i\h') }}</p>
            </div>
            @if (is_null($trabalho->nota))
                <hr>
                <h3>Avaliar Trabalho</h3>
                <form action="{{ route($route, $trabalho->id) }}" class=" px-3 pb-4 g-2 row" method="POST">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label" for="nota">Nota:</label>
                        <input class='form-control' type="number" name="nota" id="nota" step="0.01"
                            onchange="corrigirValor()" required>
                    </div>
                    <div class="col-2 d-flex align-items-end">
                        <button class="btn btn-primary form-control" type="submit">Avaliar</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <script>
        function corrigirValor() {
            nota = document.getElementById('nota');
            nota.value = nota.value.replace(',', '.');
            if (nota.value > 10 || nota.value < 0) {
                nota.value = 0;
            }
        }
    </script>
@endsection
