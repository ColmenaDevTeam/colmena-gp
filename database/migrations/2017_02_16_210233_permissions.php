<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Permissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45)->unique();
			$table->string('slug',45)->unique();
            $table->boolean('navigation')->default(false);
			$table->integer('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		if(Schema::hasTable('permissions'))
        	Schema::drop('permissions');
    }
}
