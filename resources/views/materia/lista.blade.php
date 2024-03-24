@extends('welcome')
@section('content')

<div class="topo" style="justify-content: flex-end">
    <a href="{{route('materia.adicionar')}}" class="btn btn-adicionar">Adicionar</a>
</div>

<div class="linha afastar" style="background-color: #007bff; color: #fff;">
    <div class="nome">Materia</div>
    <div class="quantidade">Topicos</div>
    <div class="quantidade">Perguntas</div>
    <div class="acoes">Açoes</div>
</div>

@foreach ($materias as $materia )
    <div class="linha" style="background-color: {{ $materia->background }}; color: {{ $materia->font }};">
        <div class="nome">{{ $materia->nome }}</div>
        <div class="quantidade">{{ $materia->topicos->count() }}</div>
        <div class="quantidade">{{ $materia->perguntas->count() }}</div>
        <div class="acoes">
            <a href="{{ route('topico.lista', $materia->id) }}" class="detalhes">Detalhes</a>
            <a href="{{ route('materia.editar', $materia->id) }}" class="editar">Editar</a>
            <a href="javascript:void(0);" onclick="if (confirm('Deletar essa materia?')) { window.location.href = '{{route('materia.destroy', $materia->id)}}'; }" class="deletar">Deletar</a>
        </div>
    </div>
@endforeach

<div align="center" class="row">
    {{ $materias->links("pagination::bootstrap-4") }}
</div>


@endsection

@section('voltar')
    <a href="{{ route('materia.home') }}" style="cursor: pointer;">Voltar</a>
@endsection
