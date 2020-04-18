<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourtCaseEmployeePivotTable extends Migration
{
    public function up()
    {
        Schema::create('court_case_employee', function (Blueprint $table) {
            $table->unsignedInteger('court_case_id');
            $table->foreign('court_case_id', 'court_case_id_fk_1332450')->references('id')->on('court_cases')->onDelete('cascade');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id', 'employee_id_fk_1332450')->references('id')->on('employees')->onDelete('cascade');
        });

    }
}
