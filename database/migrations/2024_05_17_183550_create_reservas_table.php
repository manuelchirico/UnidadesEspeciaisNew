<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_ocupante');
            $table->string('casa_a_ocupar');
            $table->date('data_entrada');
            $table->date('data_saida');
            $table->string('contacto');
            $table->integer('numero_dias')->nullable();
            $table->decimal('valor_total', 8, 2)->nullable();
            $table->string('pagamento')->default('pendente');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
