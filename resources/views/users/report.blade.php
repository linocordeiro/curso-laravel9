<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PDF</title>
    {{-- <link rel="stylesheet" href="{{ url('assets/site/css/certificate.css') }}"> --}}
</head>

<body>
    <h1>Usuários</h1>
    <ul>
        @forelse($users as $user)
            <li>Nome: {{ $user->name }} - Email: {{ $user->email }}</li>
        @empty
            <li>Nenhum Produto Cadastrado.</li>
        @endforelse
    </ul>
</body>

</html>
