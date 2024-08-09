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
         Schema::table('receitas', function (Blueprint $table) {
             $table->decimal('saidas', 10, 2)->default(0);
             $table->decimal('valor_existente', 10, 2)->virtualAs('reserva + ginasio + campo - saidas');
         });
     }
     
     public function down()
     {
         Schema::table('receitas', function (Blueprint $table) {
             $table->dropColumn('saidas');
             $table->dropColumn('valor_existente');
         });
     }


};
