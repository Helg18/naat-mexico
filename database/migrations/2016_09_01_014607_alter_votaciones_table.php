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
            $table->integer('id_iniciativa')->unsigned();
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
            $table->dropColumn('id_iniciativa');
        });
    }
}
