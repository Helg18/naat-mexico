<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetallesIni extends Migration
{
    public function up()
    {
        Schema::create('iniciativas_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_iniciativas')->unsigned();
            $table->integer('id_categoria')->unsigned();
            $table->integer('id_subcategoria')->unsigned();
            $table->integer('id_indicadores')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->string('propuesta');
            $table->integer('orden_propuesta')->unsigned();
            $table->string('evidencia_video');
            $table->string('evidencia_foto');
            $table->text('evidencia_texto');
            $table->string('is_active');
            $table->timestamps();
            $table->index(['id_iniciativas', 'id_categoria','id_user']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iniciativas_detalles');
    }
}
