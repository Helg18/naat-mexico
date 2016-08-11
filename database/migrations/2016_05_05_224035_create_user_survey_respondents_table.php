<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSurveyRespondentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_survey_respondents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->integer('nse_points');
            $table->integer('earned_points');

            $table->string('last_name');
            $table->date('day_of_birth');
            $table->string('sex');
            $table->string('marital_status');

            $table->string('state');
            $table->string('city');
            $table->string('zip');
            $table->string('address');



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
        Schema::drop('user_survey_respondents');
    }
}
