<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class MateriaController extends Controller
{
    public function home(Request $request){
        $qtd = $request['qtd'] ? : 9;
        $page = $request['page'] ?: 1;
        $buscar = $request['buscar'];

        Paginator::currentPageResolver(function () use ($page){
            return $page;
        });

        if ($buscar) {
            $materias = \App\Models\Materia::with('perguntas')->where('nome', 'LIKE', '%' . $buscar . '%')->paginate($qtd);
        } else {
            $materias = \App\Models\Materia::with('perguntas')->paginate($qtd);
        }

        $materias = $materias->appends(Request::capture()->except('page'));

        return view('materia.index', compact('materias'));
    }

    public function lista(Request $request){
        $qtd = $request['qtd'] ? : 7;
        $page = $request['page'] ?: 1;

        Paginator::currentPageResolver(function () use ($page){
            return $page;
        });

        $materias = \App\Models\Materia::with('perguntas')->paginate($qtd);

        $materias = $materias->appends(Request::capture()->except('page'));

        return view('materia.lista', compact('materias'));
    }

    public function adicionar(){

        return view('materia.create');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'background' => 'required|string|max:7',
            'font' => 'required|string|max:7',
        ]);

        \App\Models\Materia::create($validatedData);

        return redirect()->route('materia.adicionar')->with('success', 'Matéria adicionada com sucesso!');
    }

    public function edit($id)
    {
        $materia = \App\Models\Materia::find($id);

        return view('materia.edit', compact('materia'));
    }

    public function update(Request $request, $id)
    {
        $materia = \App\Models\Materia::find($id);
        $materia->update($request->all());

        return redirect()->route('materia.lista');
    }
    public function destroy($id)
    {
        $materia = \App\Models\Materia::find($id);

        $materia->deletarTopicos();

        $materia->delete();

        return redirect()->route('materia.lista');
    }

    public function shuffle(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = 1;

        $urlAtual = $request->header('referer');

        $lista = \App\Models\Pergunta::all();
        if (Str::contains($urlAtual, '/aleatorio')) {
            // Não embaralhar as perguntas se a URL contiver '/aleatorio/'
            $perguntasEmbaralhadas = session('perguntas_embaralhadas');
        } else {
            // Embaralhar as perguntas se a URL não contiver '/aleatorio/'
            $perguntasEmbaralhadas = $lista->shuffle();
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
