<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVotacioneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_iniciativa')->unsigned();
            $table->foreign('id_iniciativa')->references('id')->on('iniciativas');
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
        Schema::drop('votaciones');
    }
}
