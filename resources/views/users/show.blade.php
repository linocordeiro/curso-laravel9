@extends('layouts.app')

@section('title', 'Detalhe do usuários')
@section('content')
    <h1>Detalhe do Usuário</h1>

    <ul>
        <li>{{$user->name}}</li>
        <li>{{$user->email}}</li>
        <li><a href="{{ route('users.edit', $user->id) }}">Editar</a></li>
    </ul>

@endsection




