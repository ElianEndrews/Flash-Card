<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\TopicoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [MateriaController::class, 'home'])->name('materia.home');
Route::get('/materia/lista', [MateriaController::class, 'lista'])->name('materia.lista');
Route::get('/materia/adicionar', [MateriaController::class, 'adicionar'])->name('materia.adicionar');
Route::post('/materia/store', [MateriaController::class, 'store'])->name('materia.store');
Route::get('/materia/editar/{id}', [MateriaController::class, 'edit'])->name('materia.editar');
Route::post('/materia/update/{id}', [MateriaController::class, 'update'])->name('materia.update');
Route::get('/materia/deletar/{id}', [MateriaController::class, 'destroy'])->name('materia.destroy');
Route::get('/materia/aleatorio', [MateriaController::class, 'shuffle'])->name('materia.shuffle');

Route::get('/topico/home/{id}', [TopicoController::class, 'index'])->name('topico.home');
Route::get('/topico/lista/{id}', [TopicoController::class, 'lista'])->name('topico.lista');
Route::get('/topico/adicionar/{id}', [TopicoController::class, 'adicionar'])->name('topico.adicionar');
Route::post('/topico/store/{id}', [TopicoController::class, 'store'])->name('topico.store');
Route::get('/topico/editar/{id}', [TopicoController::class, 'edit'])->name('topico.editar');
Route::post('/topico/update/{id}', [TopicoController::class, 'update'])->name('topico.update');
Route::get('/topico/deletar/{id}', [TopicoController::class, 'destroy'])->name('topico.destroy');
Route::get('/topico/aleatorio/{id}', [TopicoController::class, 'shuffle'])->name('topico.shuffle');

Route::get('/pergunta/home/{id}', [PerguntaController::class, 'index'])->name('pergunta.home');
Route::get('/pergunta/lista/{id}', [PerguntaController::class, 'lista'])->name('pergunta.lista');
Route::get('/pergunta/adicionar/{id}', [PerguntaController::class, 'adicionar'])->name('pergunta.adicionar');
Route::post('/pergunta/store/{id}', [PerguntaController::class, 'store'])->name('pergunta.store');
Route::get('/pergunta/editar/{id}', [PerguntaController::class, 'edit'])->name('pergunta.editar');
Route::post('/pergunta/update/{id}', [PerguntaController::class, 'update'])->name('pergunta.update');
Route::get('/pergunta/deletar/{id}', [PerguntaController::class, 'destroy'])->name('pergunta.destroy');
Route::get('/pergunta/flash/{id}', [PerguntaController::class, 'flash'])->name('pergunta.flash');
Route::get('/pergunta/aleatorio/{id}', [PerguntaController::class, 'shuffle'])->name('pergunta.shuffle');
