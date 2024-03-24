<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable= [
        "nome", "background", "font"
    ];

    public function perguntas(){
        return $this->hasMany(Pergunta::class, 'materia_id', 'id');
    }

    public function topicos(){
        return $this->hasMany(Topico::class, 'materia_id', 'id');
    }


    public function addTopico(Topico $topico)
    {
        return $this->topicos()->save($topico);
    }



    public function deletarTopicos()
    {
        $this->topicos->each(function ($topico) {
            $topico->perguntas->each(function ($pergunta) {
                $pergunta->delete();
            });
            $topico->delete();
        });

        return true;
    }
}
