@extends('welcome')
@section('content')


    <div class="topo">
        <form method="GET" action="{{ route('topico.home', ['buscar' => 'search', 'id' => $materia->id])}}" class="form-pesquisa">
            <div>
                <input type="text" placeholder="Digite o nome do topico" name="buscar" class="campo-pesquisa">
                <button type="submit" class="btn btn-pesquisar">Pesquisar</button>
            </div>
        </form>
        <a href="{{ route('topico.shuffle', $materia->id) }}" class="btn btn-primary">Aleatorio</a>
        <a href="{{route('topico.lista', $materia->id)}}" class="btn btn-administrar">Administrar</a>
        <a href="{{route('topico.adicionar', $materia->id)}}" class="btn btn-adicionar">Adicionar</a>
    </div>
    <div class="lista_materias afastar">
        @foreach ($topico as $topicos )
        <a href="{{route('pergunta.home', $topicos->id )}}" class="materia" style="background-color: {{ $topicos->background }};">
            <p style="color: {{ $topicos->font }};">{{ $topicos->nome }}</p>
        </a>
        @endforeach
    </div>
    <div align="center" class="row">
        {{ $topico->links("pagination::bootstrap-4") }}
    </div>

@endsection

@section('voltar')
    <a href="{{ route('materia.home') }}" style="cursor: pointer;">Voltar</a>
@endsection
