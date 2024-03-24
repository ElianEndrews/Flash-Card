@extends('welcome')
@section('content')

    @if(session('success'))
            <div class="success-message" role="alert">
                {{ session('success') }}
            </div>

    @endif

    <div class="container_adicionar">
        <h2>Adicionar Nova Matéria</h2>
        <form method="POST" action="{{ route('materia.store') }}" class="form-adicionar">
            @csrf
            <div class="form-group">
                <label for="nome">Nome da Matéria:</label>
                <input type="text" id="nome" name="nome" class="form-texto" placeholder="Digite o nome da matéria" required>
            </div>
            <div class="form-group">
                <label for="background">Cor de Fundo:</label>
                <input type="color" id="background" name="background" class="form-cor" required >
            </div>
            <div class="form-group">
                <label for="font">Cor da Fonte:</label>
                <input type="color" id="font" name="font" class="form-cor" required value="#FFFFFF">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Matéria</button>
        </form>
    </div>

@endsection

@section('voltar')
    @if(Str::contains(url()->previous(), '/lista'))
        <a href="{{ route('materia.lista') }}" style="cursor: pointer;">Voltar</a>
    @else
        <a href="{{ route('materia.home') }}" style="cursor: pointer;">Voltar</a>
    @endif
@endsection
