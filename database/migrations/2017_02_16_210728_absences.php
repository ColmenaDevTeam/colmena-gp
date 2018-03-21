<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Absences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('type'); #medical rest, permissed absence
            $table->date('start_date');
            $table->date('end_date');
            $table->text('details');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
		if(Schema::hasTable('absences'))
        	Schema::drop('absences');
    }
}
