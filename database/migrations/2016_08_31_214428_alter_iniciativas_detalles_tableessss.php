<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIniciativasDetallesTableessss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iniciativas_detalles', function (Blueprint $table) {
           // $table->integer('pasosiniciativas_id')->unsigned();

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
            //$table->dropColumn('pasosiniciativas_id');
        });
    }
}
