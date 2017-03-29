<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Calendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('calendar', function (Blueprint $table) {
            $table->date('workable_date')->unique();
            $table->primary('workable_date');  //Add a primary key.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		if(Schema::hasTable('calendar'))
        Schema::drop('calendar');
    }
}
