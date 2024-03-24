@extends('welcome')
@section('content')



    @if(session('success'))
            <div class="success-message" role="alert">
                {{ session('success') }}
            </div>

    @endif

    <div class="container_adicionar">
        <h2>Adicionar Nova Pergunta</h2>


        <form method="POST" action="{{route ('pergunta.store', $topico->id)}}" class="form-adicionar">
            @csrf
            <div class="form-group">
                <label for="nome">Pergunta</label>
                <input type="text" id="pergunta" name="pergunta" class="form-texto" placeholder="Digite a pergunta" required>
            </div>
            <div class="form-group">
                <label for="resposta">Resposta</label>
                <input type="text" id="resposta" name="resposta" class="form-texto" placeholder="Digite a resposta" required>
            </div>

            <button type="submit" class="btn btn-primary">Adicionar pergunta</button>
        </form>
    </div>

@endsection

@section('voltar')
    @if(Str::contains(url()->previous(), '/lista'))
        <a href="{{ route('pergunta.lista', $topico->id) }}" style="cursor: pointer;">Voltar</a>
    @else
        <a href="{{ route('pergunta.home',  $topico->id) }}" style="cursor: pointer;">Voltar</a>
    @endif
@endsection
