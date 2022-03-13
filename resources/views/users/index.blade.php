@extends('layouts.app')

@section('title', 'Listagem de usuários')
@section('content')
    <h1>Listagem de Usuários</h1>

    <form action="{{ route('users.index') }}" method="get">
        <input type="text" name="search" id="">
        <input type="submit" value="Pesquisar">
    </form>


    <a href="{{ route('users.create') }}" class="btn">Cadastrar Usuário</a>
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>AÇÕES</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{ route('users.show', $user->id) }}">Detalhes</a><br>
                    <a href="{{ route('users.edit', $user->id) }}">Editar</a>
                    <form action="{{ route('users.delete', $user->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
