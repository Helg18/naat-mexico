<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIniciativasVotacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iniciativas_votaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iniciativas_id')->unsigned();
            $table->foreign('iniciativas_id')->references('id')->on('tips');
            $table->integer('calificacion');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->text('comentario')->nullable();
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
        Schema::drop('iniciativas_votaciones');
    }
}
