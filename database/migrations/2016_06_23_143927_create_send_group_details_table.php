<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendGroupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_group_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('send_group_id')->unsigned();
            $table->foreign('send_group_id')
                ->references('id')->on('send_groups')
                ->onDelete('cascade');
            $table->string('email');


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
        Schema::drop('send_group_details');
    }
}
