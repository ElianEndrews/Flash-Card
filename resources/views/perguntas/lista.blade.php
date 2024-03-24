@extends('welcome')
@section('content')

<div class="topo" style="justify-content: flex-end">
    <a href="{{route('pergunta.adicionar', $topico->id)}}" class="btn btn-adicionar">Adicionar</a>
</div>

<div class="linha afastar" style="background-color: #007bff; color: #fff;">
    <div class="nome" style="width: 40%!important">Pergunta</div>
    <div class="acoes">Açoes</div>
</div>

@foreach ($perguntas as $pergunta )
    <div class="linha" style="background-color: {{ $topico->background }}; color: {{ $topico->font }};">
        <div class="nome" style="width: 40%!important">{{ strlen($pergunta->pergunta) > 40 ? substr($pergunta->pergunta, 0, 40) . '...' : $pergunta->pergunta }}</div>
        <div class="acoes">
            <a href="{{route('pergunta.editar', $pergunta->id)}}"class="editar">Editar</a>
            <a href="javascript:void(0);" onclick="if (confirm('Deletar essa pergunta?')) { window.location.href = '{{route('pergunta.destroy', $pergunta->id)}}'; }" class="deletar">Deletar</a>
        </div>
    </div>
@endforeach

<div align="center" class="row">
    {{ $perguntas->links("pagination::bootstrap-4") }}
</div>


@endsection

@section('voltar')
    @if(Str::contains(url()->previous(), '/topico/lista'))
        <a href="{{ route('topico.lista', $topico->materia_id) }}" style="cursor: pointer;">Voltar</a>
    @else
        <a href="{{ route('pergunta.home',  $topico->id) }}" style="cursor: pointer;">Voltar</a>
    @endif
@endsection
