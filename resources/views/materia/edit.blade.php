@extends('welcome')
@section('content')

    <div class="container_adicionar">
        <h2>Editar Matéria</h2>
        <form method="POST" action="{{route ('materia.update', $materia->id)}}" class="form-adicionar">
            @csrf
            <div class="form-group">
                <label for="nome">Nome da Matéria:</label>
                <input type="text" id="nome" name="nome" class="form-texto" value="{{$materia->nome}}" required>
            </div>
            <div class="form-group">
                <label for="background">Cor de Fundo:</label>
                <input type="color" id="background" name="background" class="form-cor" value="{{$materia->background}}" required>
            </div>
            <div class="form-group">
                <label for="font">Cor da Fonte:</label>
                <input type="color" id="font" name="font" class="form-cor" value="{{$materia->font}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Editar Matéria</button>
        </form>
    </div>

@endsection

@section('voltar')
    <a href="{{ route('materia.lista') }}" style="cursor: pointer;">Voltar</a>
@endsection
