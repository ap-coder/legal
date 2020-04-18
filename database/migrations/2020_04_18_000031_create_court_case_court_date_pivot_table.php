<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourtCaseCourtDatePivotTable extends Migration
{
    public function up()
    {
        Schema::create('court_case_court_date', function (Blueprint $table) {
            $table->unsignedInteger('court_date_id');
            $table->foreign('court_date_id', 'court_date_id_fk_254307')->references('id')->on('court_dates')->onDelete('cascade');
            $table->unsignedInteger('court_case_id');
            $table->foreign('court_case_id', 'court_case_id_fk_254307')->references('id')->on('court_cases')->onDelete('cascade');
        });

    }
}
