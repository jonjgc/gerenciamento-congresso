@extends('layouts.app')

@section('titulo', 'Pagina Inicial')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de Trabalhos</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Trabalho</th>
                                        <th>Autor</th>
                                        <th>Universidade</th>
                                        @auth()
                                            @if (auth()->user()->role_id != \App\Models\Role::PARTICIPANTE)
                                                <th>Nota</th>
                                                <th>Ações</th>
                                            @endif
                                        @endauth
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trabalhos as $trabalho)
                                        <tr>
                                            <td>{{ $trabalho->titulo }}</td>
                                            <td>{{ $trabalho->autor }}</td>
                                            <td>{{ 'Universidade' }}</td>
                                            @auth()
                                                @if (auth()->user()->role_id != \App\Models\Role::PARTICIPANTE)
                                                    <td>{{ $trabalho->nota }}</td>
                                                @endif
                                                @if (auth()->user()->role_id == \App\Models\Role::ADMIN)
                                                    <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('visualizar-trabalho', $trabalho->id) }}">
                                                            Visualizar
                                                        </a>
                                                    </td>
                                                @endif
                                                @if (auth()->user()->role_id == \App\Models\Role::CORRETOR)
                                                    <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('corretor-visualizar-trabalho', $trabalho->id) }}">
                                                            Visualizar
                                                        </a>
                                                    </td>
                                                @endif
                                                @if (auth()->user()->role_id == \App\Models\Role::EDITOR)
                                                    <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('editor-visualizar-trabalho', $trabalho->id) }}">
                                                            Visualizar
                                                        </a>
                                                    </td>
                                                @endif
                                            @endauth
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $trabalhos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
