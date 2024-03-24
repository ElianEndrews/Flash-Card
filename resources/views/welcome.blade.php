<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flash-Card</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perguntas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materias.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paginate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabela.css') }}">
</head>
<body>
    <header>
        <a href="/">Inicio</a>
        <a href="/materia/lista">Administrar</a>
        @if(!Request::is('/'))
            {{-- <a onclick="window.history.back();" style="cursor: pointer;">Voltar</a> --}}
            @yield('voltar')
        @endif
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
