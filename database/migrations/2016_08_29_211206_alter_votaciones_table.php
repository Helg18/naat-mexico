<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVotacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votaciones', function (Blueprint $table) {

            $table->dropForeign('votaciones_id_iniciativa_foreign');
            $table->dropColumn('id_iniciativa');
            $table->integer('iniciativa_id')->unsigned();
            $table->foreign('iniciativa_id')->references('id')->on('iniciativas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votaciones', function (Blueprint $table) {            
            $table->integer('id_iniciativa')->unsigned();
            $table->foreign('id_iniciativa')->references('id')->on('iniciativas');
            $table->dropColumn('iniciativa_id');
            $table->dropForeign(['iniciativa_id']);

        });
    }
}
