<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Departments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
			$table->text('description');
            #$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		if(Schema::hasTable('departments'))
        	Schema::drop('departments');
    }
}
