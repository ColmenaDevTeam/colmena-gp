<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Roles extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45)->unique();
			$table->string('slug',45)->unique();
            $table->integer('level')->default(2);
			$table->nullableTimestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
		if(Schema::hasTable('roles'))
        	Schema::drop('roles');
    }
}
