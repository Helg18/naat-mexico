<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIniciativasDetalles2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iniciativas_detalles', function (Blueprint $table) {
            $table->DropColumn('id_indicadores');
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
            $table->integer('id_indicadores')->unsigned();
        });
    }
}
