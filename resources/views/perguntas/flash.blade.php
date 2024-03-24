@extends('welcome')
@section('content')
<main>

    <div class="card box">
        @foreach ($perguntasPaginadas as $pergunta)
        <div class="face back" style="background-color: {{ $pergunta->topico->background }}; color: {{ $pergunta->topico->font }};">{{$pergunta->resposta}}</div>
        <div class="face front" style="background-color: {{ $pergunta->topico->background }}; color: {{ $pergunta->topico->font }};">{{$pergunta->pergunta}}</div>
        @endforeach
    </div>
    <textarea class="text"></textarea>
    <div align="center" class="row">
        @if ($perguntasPaginadas->currentPage() > 1)
            <a href="{{ $perguntasPaginadas->previousPageUrl() }}" class="seta-anterior">&#9664;</a>
        @endif

        @if ($perguntasPaginadas->hasMorePages())
            <a href="{{ $perguntasPaginadas->nextPageUrl() }}" class="seta-proxima">&#9654;</a>
        @endif
    </div>
</main>

@endsection

@section('voltar')
    @foreach ($perguntasPaginadas as $pergunta)
        @if(Str::contains(url()->previous(), '/topico'))
            <a href="{{ route('topico.home', $pergunta->materia_id) }}" style="cursor: pointer;">Voltar</a>
        @elseif(Str::contains(url()->previous(), '/pergunta'))
            <a href="{{ route('pergunta.home', $pergunta->topico_id) }}" style="cursor: pointer;">Voltar</a>
        @else
            <a href="{{ route('materia.home') }}" style="cursor: pointer;">Voltar</a>
        @endif
    @endforeach
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var flashCards = document.querySelectorAll('.face');

        flashCards.forEach(function(flashCard) {
            flashCard.addEventListener('click', function() {
                this.parentNode.classList.toggle('girar_carta');
            });
        });
    });
</script>


