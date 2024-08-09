<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campos', function (Blueprint $table) {
            $table->integer('tempo_total')->after('hora_fim'); // Tempo total em minutos
            $table->decimal('pagamento', 10, 2)->after('tempo_total'); // Pagamento
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campos', function (Blueprint $table) {
            $table->dropColumn('tempo_total');
            $table->dropColumn('pagamento');
        });
    }
};



