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
        Schema::table('ginasios', function (Blueprint $table) {
            $table->decimal('pagamento', 10, 2)->nullable()->after('responsavel');
        });
    }

    public function down()
    {
        Schema::table('ginasios', function (Blueprint $table) {
            $table->dropColumn('pagamento');
        });
    }
};
