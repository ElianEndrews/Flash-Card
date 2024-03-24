<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    protected $fillable= [
        "materia_id", "topico_id", "ordem","pergunta" , "resposta"
    ];

    public function materia() {
        return $this->belongsTo('App\Models\Materia');
    }

    public function topico()
    {
        return $this->belongsTo(Topico::class);
    }

    public function recontarOrdem($topico_id)
    {
        self::where('topico_id', $topico_id)
            ->orderBy('ordem')
            ->each(function ($pergunta, $index) {
                $pergunta->update(['ordem' => $index + 1]);
            });
    }
}
