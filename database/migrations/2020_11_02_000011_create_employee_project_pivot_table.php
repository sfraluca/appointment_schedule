<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeProjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('employee_project', function (Blueprint $table) {
            $table->unsignedInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_2509533')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id', 'employee_id_fk_2509533')->references('id')->on('employees')->onDelete('cascade');
        });
    }
}
