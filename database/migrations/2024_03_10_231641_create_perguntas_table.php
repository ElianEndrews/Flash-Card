<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('materia_id')->unsigned();
            $table->integer('topico_id')->unsigned();
            $table->integer('ordem')->nullable();
            $table->string('pergunta');
            $table->string('resposta');
            $table->timestamps();
        });

        Schema::table('perguntas', function (Blueprint $table){
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->foreign('topico_id')->references('id')->on('topicos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguntas');
    }
};
