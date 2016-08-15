<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReglasdeljuegoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglasdeljuego', function (Blueprint $table) {
            $table->increments('id');
            $table->string('regla');
            $table->string('descripcion_regla');
            $table->string('is_active');
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
        Schema::drop('reglasdeljuego');
    }
}
