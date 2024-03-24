@extends('welcome')
@section('content')


    @if(session('success'))
            <div class="success-message" role="alert">
                {{ session('success') }}
            </div>

    @endif

    <div class="container_adicionar">
        <h2>Adicionar Novo Topico</h2>


        <form method="POST" action="{{route ('topico.store', $materia->id)}}" class="form-adicionar">
            @csrf
            <div class="form-group">
                <label for="nome">Nome do topico:</label>
                <input type="text" id="nome" name="nome" class="form-texto" placeholder="Digite o nome do topico" required>
            </div>
            <div class="form-group">
                <label for="background">Cor de Fundo:</label>
                <input type="color" id="background" name="background" class="form-cor" required value="{{$materia->background}}">
            </div>
            <div class="form-group">
                <label for="font">Cor da Fonte:</label>
                <input type="color" id="font" name="font" class="form-cor" required value="{{$materia->font}}">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Topico</button>
        </form>
    </div>

@endsection

@section('voltar')
    @if(Str::contains(url()->previous(), '/lista'))
        <a href="{{ route('topico.lista', $materia->id) }}" style="cursor: pointer;">Voltar</a>
    @else
        <a href="{{ route('topico.home',  $materia->id) }}" style="cursor: pointer;">Voltar</a>
    @endif
@endsection

