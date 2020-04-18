<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttorneyCourtCasePivotTable extends Migration
{
    public function up()
    {
        Schema::create('attorney_court_case', function (Blueprint $table) {
            $table->unsignedInteger('court_case_id');
            $table->foreign('court_case_id', 'court_case_id_fk_1332449')->references('id')->on('court_cases')->onDelete('cascade');
            $table->unsignedInteger('attorney_id');
            $table->foreign('attorney_id', 'attorney_id_fk_1332449')->references('id')->on('attorneys')->onDelete('cascade');
        });

    }
}
