<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PerguntaController extends Controller
{
    public function index(Request $request, $id)
    {
        $qtd = $request['qtd'] ? : 9;
        $page = $request['page'] ?: 1;
        $buscar = $request['buscar'];

        Paginator::currentPageResolver(function () use ($page){
            return $page;
        });

        $topico = \App\Models\Topico::find($id);
        $pergunta = $topico->perguntas();

        if ($buscar) {
            $pergunta->where('pergunta', 'LIKE', '%' . $buscar . '%');
        }

        $pergunta = $pergunta->paginate($qtd);

        $pergunta = $pergunta->appends(Request::capture()->except('page'));

        return view('perguntas.index', compact('pergunta', 'topico'));
    }

    public function lista(Request $request, $id)
    {
        $qtd = $request['qtd'] ?: 7;
        $page = $request['page'] ?: 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        // Encontre a matéria específica pelo ID fornecido
        $topico = \App\Models\Topico::findOrFail($id);

        $perguntas = $topico->perguntas()->paginate($qtd);

        $perguntas = $perguntas->appends(Request::capture()->except('page'));

        return view('perguntas.lista', compact('perguntas', 'topico'));
    }

    public function adicionar($id){

        $topico = \App\Models\Topico::find($id);

        return view('perguntas.create', compact('topico'));

    }

    public function store(Request $request, $id)
    {
        $topico = \App\Models\Topico::find($id);

        // Encontre a última pergunta com o mesmo topico_id
        $ultimaPergunta = \App\Models\Pergunta::where('topico_id', $id)->orderBy('ordem', 'desc')->first();

        // Determine a ordem da nova pergunta
        $ordem = $ultimaPergunta ? $ultimaPergunta->ordem + 1 : 1;

        $validatedData = $request->validate([
            'pergunta' => 'required|string',
            'resposta' => 'required|string',
        ]);

        $validatedData['materia_id'] = $topico->materia_id;
        $validatedData['topico_id'] = $id;
        $validatedData['ordem'] = $ordem;

        \App\Models\Pergunta::create($validatedData);

        return redirect()->route('pergunta.adicionar', ['id' => $id])->with('success', 'Pergunta adicionada com sucesso!');
    }

    public function edit($id)
    {
        $pergunta = \App\Models\Pergunta::find($id);

        return view('perguntas.edit', compact('pergunta'));
    }

    public function update(Request $request, $id)
    {
        $pergunta = \App\Models\Pergunta::find($id);
        $pergunta->update($request->all());

        return redirect()->route('pergunta.lista', ['id' => $pergunta->topico_id]);
    }

    public function destroy($id)
    {
        $pergunta = \App\Models\Pergunta::find($id);

        $topico_id = $pergunta->topico_id;

        $pergunta->delete();

        $pergunta->recontarOrdem($topico_id);

        return redirect()->route('pergunta.lista', ['id' => $topico_id]);
    }


    public function flash(Request $request, $id)
    {
        $topico = \App\Models\Topico::findOrFail($id);
        $perguntas = $topico->perguntas();

        // Obter o número da página atual
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 1;

        $total = $perguntas->count();

        // Obter o índice da pergunta clicada (se fornecido)
        $indicePergunta = $request->query('indice');

        if ($indicePergunta !== null) {
            $currentPage = ceil(($indicePergunta + 1) / $perPage);
        }

        $items = $perguntas->forPage($currentPage, $perPage)->get();

        $perguntasPaginadas = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
            'path' => route('pergunta.flash', $topico->id),
        ]);

        return view('perguntas.flash', compact('perguntasPaginadas', 'topico'));
    }


    public function shuffle(Request $request, $id)
    {
        $page = $request->query('page', 1);
        $perPage = 1;

        $urlAtual = $request->header('referer');

        $lista = \App\Models\Topico::findOrFail($id);
        if (Str::contains($urlAtual, '/aleatorio/')) {
            // Não embaralhar as perguntas se a URL contiver '/aleatorio/'
            $perguntasEmbaralhadas = session('perguntas_embaralhadas');
        } else {
            // Embaralhar as perguntas se a URL não contiver '/aleatorio/'
            $perguntasEmbaralhadas = $lista->perguntas()->inRandomOrder()->get();
            session(['perguntas_embaralhadas' => $perguntasEmbaralhadas]);
        }

        $total = $perguntasEmbaralhadas->count();
        $items = $perguntasEmbaralhadas->forPage($page, $perPage);


        $perguntasPaginadas = new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

        return view('perguntas.flash', compact('perguntasPaginadas', 'lista'));
    }

}
