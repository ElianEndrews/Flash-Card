@extends('welcome')
@section('content')

    <div class="topo">
        <form method="GET" action="{{ route('pergunta.home', ['buscar' => 'search', 'id' => $topico->id])}}" class="form-pesquisa">
            <div>
                <input type="text" placeholder="Digite o conteudo da pergunta" name="buscar" class="campo-pesquisa">
                <button type="submit" class="btn btn-pesquisar">Pesquisar</button>
            </div>
        </form>
        <a href="{{ route('pergunta.shuffle', $topico->id) }}" class="btn btn-primary">Aleatorio</a>
        <a href="{{route('pergunta.lista', $topico->id)}}" class="btn btn-administrar">Administrar</a>
        <a href="{{route('pergunta.adicionar', $topico->id)}}" class="btn btn-adicionar">Adicionar</a>
    </div>
    <div class="lista_materias afastar">
        @foreach ($pergunta as $index => $perguntas )
        <a href="{{ route('pergunta.flash', ['id' => $topico->id, 'indice' => $loop->index]) }}" class="materia" style="background-color: {{ $topico->background }};" title="{{ $perguntas->pergunta }}">
            <p style="color: {{ $topico->font }};">{{ $perguntas->ordem }}</p>
        </a>
        @endforeach
    </div>
    <div align="center" class="row">
        {{ $pergunta->links("pagination::bootstrap-4") }}
    </div>

@endsection

@section('voltar')
    <a href="{{ route('topico.home', $topico->materia_id) }}" style="cursor: pointer;">Voltar</a>
@endsection
