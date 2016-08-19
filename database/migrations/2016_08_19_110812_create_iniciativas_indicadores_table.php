<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIniciativasIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iniciativas_indicadores', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('id_iniciativas')->unsigned();
            $table->foreign('id_iniciativas')->references('id')->on('iniciativas');
            $table->integer('id_indicadores')->unsigned();
            $table->foreign('id_indicadores')->references('id')->on('indicadores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iniciativas_indicadores');
    }
}
