<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIniciativasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iniciativas_detalles', function (Blueprint $table) {
            $table->dropForeign('iniciativas_detalles_id_indicadores_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iniciativas_detalles', function (Blueprint $table) {
            $table->foreign('id_indicadores')->references('id')->on('indicadores');
        });
    }
}
