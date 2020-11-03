<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedInteger('client_id');
            $table->foreign('client_id', 'client_fk_2468701')->references('id')->on('clients');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id', 'employee_fk_2468702')->references('id')->on('employees');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2510573')->references('id')->on('users');
        });
    }
}
