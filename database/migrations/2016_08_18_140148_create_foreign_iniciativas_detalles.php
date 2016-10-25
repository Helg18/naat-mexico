<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignIniciativasDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iniciativas_detalles', function ($table) {
            $table->foreign('id_iniciativas')->references('id')->on('iniciativas');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_indicadores')->references('id')->on('indicadores');
            $table->foreign('id_subcategoria')->references('id')->on('subcategorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iniciativas_detalles', function ($table) {
           $table->dropForeign('iniciativas_detalles_id_categoria_foreign');
           $table->dropForeign('iniciativas_detalles_id_iniciativas_foreign');
           $table->dropForeign('iniciativas_detalles_id_user_foreign');
           $table->dropForeign('iniciativas_detalles_id_indicadores_foreign');
           $table->dropForeign('iniciativas_detalles_id_subcategoria_foreign');
        });
    }
}
