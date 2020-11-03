<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkingHoursTable extends Migration
{
    public function up()
    {
        Schema::table('working_hours', function (Blueprint $table) {
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id', 'employee_fk_2468688')->references('id')->on('employees');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2510572')->references('id')->on('users');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id', 'project_fk_2512852')->references('id')->on('projects');
        });
    }
}
