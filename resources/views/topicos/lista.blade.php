@extends('welcome')
@section('content')

<div class="topo" style="justify-content: flex-end">
    <a href="{{route('topico.adicionar', $materia->id)}}" class="btn btn-adicionar">Adicionar</a>
</div>

<div class="linha afastar" style="background-color: #007bff; color: #fff;">
    <div class="nome">Topico</div>
    <div class="quantidade">Perguntas</div>
    <div class="acoes">Açoes</div>
</div>

@foreach ($topicos as $topico )
    <div class="linha" style="background-color: {{ $topico->background }}; color: {{ $topico->font }};">
        <div class="nome">{{ $topico->nome }}</div>
        <div class="quantidade">{{ $topico->perguntas->count() }}</div>
        <div class="acoes">
            <a href="{{route('pergunta.lista', $topico->id)}}" class="detalhes">Detalhes</a>
            <a href="{{route('topico.editar', $topico->id)}}" class="editar">Editar</a>
            <a href="javascript:void(0);" onclick="if (confirm('Deletar esse topico?')) { window.location.href = '{{route('topico.destroy', $topico->id)}}'; }" class="deletar">Deletar</a>
        </div>
    </div>
@endforeach

<div align="center" class="row">
    {{ $topicos->links("pagination::bootstrap-4") }}
</div>


@endsection

@section('voltar')
    @if(Str::contains(url()->previous(), '/materia/lista'))
        <a href="{{ route('materia.lista') }}" style="cursor: pointer;">Voltar</a>
    @elseif(Str::contains(url()->previous(), '/pergunta/lista'))
        <a href="{{ route('materia.lista') }}" style="cursor: pointer;">Voltar</a>
    @else
        <a href="{{ route('topico.home',  $materia->id) }}" style="cursor: pointer;">Voltar</a>
    @endif
@endsection
