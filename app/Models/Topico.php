<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topico extends Model
{
    use HasFactory;

    protected $fillable = [
        "materia_id", "nome", "background", "font"
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function perguntas()
    {
        return $this->hasMany(Pergunta::class, 'topico_id', 'id');
    }

    public function addPergunta(Pergunta $pergunta)
    {
        return $this->perguntas()->save($pergunta);
    }

    public function deletarPerguntas()
    {
        $this->perguntas->each(function ($pergunta) {
            $pergunta->delete();
        });

        return true;
    }
}
