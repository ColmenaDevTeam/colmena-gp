<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Database extends Migration
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

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('estimated_date');
            $table->text('details');
            $table->integer('priority');
            $table->integer('complexity');
            $table->enum('type',['Academico-Docente','Administrativas','Creacion intelectual','Integracion Social','Administrativo-Docente','Produccion']);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45)->unique();
            $table->string('slug',45)->unique();
            $table->integer('level')->default(2);
            $table->nullableTimestamps();
        });
        Schema::create('users_has_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category', 45);
            $table->string('action',45);
            $table->string('slug',45)->unique();
            $table->boolean('navigation')->default(false);
            $table->integer('level');
        });
        Schema::create('roles_has_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            //$table->nullableTimestamps();
        });
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
        Schema::create('recurring_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',45);
            $table->enum('frequency',['Semanal','Mensual','Bimensual','Trimestral','Semestral']);
            $table->integer('deliverer_days');
            $table->text('details');
            $table->integer('priority');
            $table->integer('complexity');
            $table->enum('task_type',['Academico-Docente','Administrativas','Creacion intelectual','Integracion Social','Administrativo-Docente','Produccion']);
            $table->date('start_date');
            $table->date('last_launch')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('users_has_recurring_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('creator_user')->default(false);
            $table->integer('recurring_activity_id')->unsigned();
            $table->foreign('recurring_activity_id')->references('id')->on('recurring_activities')->onDelete('cascade');
        });
        Schema::create('calendar', function (Blueprint $table) {
            $table->increments('id');
            $table->date('workable_date')->unique();
        });
        Schema::create('report_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uri');
        });
        Schema::create('commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string('description');
        });
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reason');
            $table->dateTime('date');
            $table->string('place');
            $table->string('agreements');
            $table->enum('status',['Agendada','Cumplida','Cancelada','Diferida'])->default('Agendada');
            $table->string('topics');
            $table->string('observations');
        });
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('message');
            $table->boolean('seen');
            $table->timestamps();
        });
        Schema::create('users_has_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('commission_id')->unsigned();
            $table->foreign('commission_id')->references('id')->on('commissions')->onDelete('cascade');
            $table->boolean('leader');
        });
        Schema::create('users_has_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('meeting_id')->unsigned();
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');
            $table->boolean('attendance')->default('false');
        });
        Schema::create('users_has_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status',['Asignada','Revision','Cumplida','Cancelada','Diferida','Retardada'])->default('Asignada');
            $table->date('deliver_date')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->text('details')->nullable();
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
        if(Schema::hasTable('departments')) Schema::drop('departments');
        if(Schema::hasTable('users')) Schema::drop('users');
        if(Schema::hasTable('password_resets')) Schema::drop('password_resets');
        if(Schema::hasTable('tasks')) Schema::drop('tasks');
        if(Schema::hasTable('roles')) Schema::drop('roles');
        if(Schema::hasTable('users_has_roles')) Schema::drop('users_has_roles');
        if(Schema::hasTable('permissions')) Schema::drop('permissions');
        if(Schema::hasTable('roles_has_permissions')) Schema::drop('roles_has_permissions');
        if(Schema::hasTable('absences')) Schema::drop('absences');
        if(Schema::hasTable('recurring_activities')) Schema::drop('recurring_activities');
        if(Schema::hasTable('users_has_recurring_activities')) Schema::drop('users_has_recurring_activities');
        if(Schema::hasTable('calendar')) Schema::drop('calendar');
        if(Schema::hasTable('commissions')) Schema::drop('commissions');
        if(Schema::hasTable('meetings')) Schema::drop('meetings');
        if(Schema::hasTable('notifications')) Schema::drop('notifications');
        if(Schema::hasTable('report_headers')) Schema::drop('report_headers');
        if(Schema::hasTable('user_has_commissions')) Schema::drop('user_has_commissions');
        if(Schema::hasTable('user_has_meetings')) Schema::drop('user_has_meetings');
        if(Schema::hasTable('user_has_tasks')) Schema::drop('user_has_tasks');

    }
}
