<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGinasioTable extends Migration
{
    public function up()
    {
        Schema::create('ginasios', function (Blueprint $table) {
            $table->id();
            $table->string('entidade');
            $table->string('nome_instituicao')->nullable();
            $table->string('nome_ocupante');
            $table->string('tipo_evento');
            $table->date('data_evento');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('contacto');
            $table->string('responsavel')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ginasio');
    }
}
