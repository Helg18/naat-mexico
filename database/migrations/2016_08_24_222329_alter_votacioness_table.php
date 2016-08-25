<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVotacionessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('votaciones');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_iniciativa');
            $table->integer('calificaicon');
            $table->integer('id_user');
            $table->text('comentario');
            $table->timestamps();
        });
    }
}
