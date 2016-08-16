<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFechas2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fechas', function (Blueprint $table) {
            $table->text('descripcion_fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fechas', function (Blueprint $table) {
            $table->dropColumn('descripcion_fecha');
        });
    }
}
