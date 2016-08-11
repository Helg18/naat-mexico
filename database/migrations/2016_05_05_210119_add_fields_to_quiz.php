<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            //
            $table->dropColumn('nse_level');
            $table->integer('nse_level_id')->unsigned()->nullable()->after('company_id');
            $table->foreign('nse_level_id')
                ->references('id')->on('nse_levels')
                ->onDelete('cascade');
            $table->integer('points')->after('name');
            $table->boolean('is_private')->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            //
            $table->integer('nse_level');
            $table->dropColumn('nse_level_id');
            $table->dropColumn('points');
            $table->dropColumn('is_private');
        });
    }
}
