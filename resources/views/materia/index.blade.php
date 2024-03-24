@extends('welcome')
@section('content')

    <div class="topo">
        <form method="GET" action="{{ route('materia.home', 'buscar')}}" class="form-pesquisa">
            <div>
                <input type="text" placeholder="Digite o nome da matéria" name="buscar" class="campo-pesquisa">
                <button type="submit" class="btn btn-pesquisar">Pesquisar</button>
            </div>
        </form>
        <a href="{{ route('materia.shuffle') }}" class="btn btn-primary">Aleatorio</a>
        <a href="{{route('materia.adicionar')}}" class="btn btn-adicionar">Adicionar</a>
    </div>

    <div class="lista_materias afastar">
        @foreach ($materias as $materia )
        <a href="{{route('topico.home', $materia->id)}}" class="materia" style="background-color: {{ $materia->background }};">
            <p style="color: {{ $materia->font }};">{{ $materia->nome }}</p>
        </a>
        @endforeach
    </div>
    <div align="center" class="row">
        {{ $materias->links("pagination::bootstrap-4") }}
    </div>

@endsection
