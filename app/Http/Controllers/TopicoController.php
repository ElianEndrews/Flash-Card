<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;


class TopicoController extends Controller
{
    public function index(Request $request, $id)
    {
        $qtd = $request['qtd'] ? : 9;
        $page = $request['page'] ?: 1;
        $buscar = $request['buscar'];

        Paginator::currentPageResolver(function () use ($page){
            return $page;
        });

        $materia = \App\Models\Materia::find($id);
        $topico = $materia->topicos();

        if ($buscar) {
            $topico->where('nome', 'LIKE', '%' . $buscar . '%');
        }

        $topico = $topico->paginate($qtd);

        $topico = $topico->appends(Request::capture()->except('page'));

        return view('topicos.index', compact('topico', 'materia'));
    }

    public function lista(Request $request, $id)
    {
        $qtd = $request['qtd'] ?: 7;
        $page = $request['page'] ?: 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        // Encontre a matéria específica pelo ID fornecido
        $materia = \App\Models\Materia::findOrFail($id);

        $topicos = $materia->topicos()->paginate($qtd);

        $topicos = $topicos->appends(Request::capture()->except('page'));

        return view('topicos.lista', compact('topicos', 'materia'));
    }


    public function adicionar($id){

        $materia = \App\Models\Materia::find($id);

        return view('topicos.create', compact('materia'));

    }

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'background' => 'required|string|max:7',
            'font' => 'required|string|max:7',
        ]);

        $validatedData['materia_id'] = $id;

        \App\Models\Topico::create($validatedData);

        return redirect()->route('topico.adicionar', $id)->with('success', 'Topico adicionado com sucesso!');
    }

    public function edit($id)
    {
        $topico = \App\Models\Topico::find($id);

        return view('topicos.edit', compact('topico'));
    }

    public function update(Request $request, $id)
    {
        $topico = \App\Models\Topico::find($id);
        $topico->update($request->all());

        return redirect()->route('topico.lista', ['id' => $topico->materia_id]);
    }

    public function destroy($id)
    {
        $topico = \App\Models\Topico::find($id);

        $materia_id = $topico->materia_id;

        $topico->deletarPerguntas();

        $topico->delete();

        return redirect()->route('topico.lista', ['id' => $materia_id]);
    }

    public function shuffle(Request $request, $id)
    {
        $page = $request->query('page', 1);
        $perPage = 1;

        $urlAtual = $request->header('referer');

        $lista = \App\Models\Materia::findOrFail($id);
        if (Str::contains($urlAtual, '/aleatorio')) {
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
