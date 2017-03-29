<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 15)->unique();
			$table->string('firstname', 45);
			$table->string('lastname', 45);
			$table->enum('user_type', ['Docente','Administrativo','Mantenimiento']);
			$table->string('phone', 15);
            $table->string('email')->unique();
            $table->string('password');
			$table->date('birthdate');
			$table->boolean('gender');
			$table->boolean('active')->default(true);
			$table->integer('department_id')->unsigned();
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
            $table->rememberToken();
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
		if(Schema::hasTable('users'))
        	Schema::drop('users');
    }
}
