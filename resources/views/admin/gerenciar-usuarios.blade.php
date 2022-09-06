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

        <h1>Gerenciar Usuários</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo de Usuário</th>
                        <th>Email</th>
                        <th>Data de Cadastro</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ \App\Models\Role::NAMES[$user->role_id] }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y \à\s H:i\h') }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <a class="btn btn-primary"
                                    href="{{ route('visualizar-usuario', $user->id) }}">Visualizar</a>
                                <a class="btn btn-warning" href="{{ route('editar-usuario', $user->id) }}">Editar</a>
                                <form action="{{ route('deletar-usuario', $user->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection
