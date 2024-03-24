@extends('welcome')
@section('content')


    <div class="container_adicionar">
        <h2>Editar Pergunta</h2>
        <form method="POST" action="{{route ('pergunta.update', $pergunta->id)}}" class="form-adicionar">
            @csrf
            <div class="form-group">
                <label for="nome">Pergunta</label>
                <input type="text" id="pergunta" name="pergunta" class="form-texto" placeholder="Digite a pergunta" required value="{{$pergunta->pergunta}}">
            </div>
            <div class="form-group">
                <label for="resposta">Resposta</label>
                <input type="text" id="resposta" name="resposta" class="form-texto" placeholder="Digite a resposta" required value="{{$pergunta->resposta}}">
            </div>

            <button type="submit" class="btn btn-primary">Editar pergunta</button>
        </form>
    </div>

@endsection

@section('voltar')
        <a href="{{ route('pergunta.lista', $pergunta->topico_id) }}" style="cursor: pointer;">Voltar</a>
@endsection
