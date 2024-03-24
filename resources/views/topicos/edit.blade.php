@extends('welcome')
@section('content')

    <div class="container_adicionar">
        <h2>Editar Topico</h2>
        <form method="POST" action="{{route ('topico.update', $topico->id)}}" class="form-adicionar">
            @csrf
            <div class="form-group">
                <label for="nome">Nome da Matéria:</label>
                <input type="text" id="nome" name="nome" class="form-texto" value="{{$topico->nome}}" required>
            </div>
            <div class="form-group">
                <label for="background">Cor de Fundo:</label>
                <input type="color" id="background" name="background" class="form-cor" value="{{$topico->background}}" required>
            </div>
            <div class="form-group">
                <label for="font">Cor da Fonte:</label>
                <input type="color" id="font" name="font" class="form-cor" value="{{$topico->font}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Editar Topico</button>
        </form>
    </div>

@endsection

@section('voltar')
        <a href="{{ route('topico.lista', $topico->materia_id) }}" style="cursor: pointer;">Voltar</a>
@endsection
