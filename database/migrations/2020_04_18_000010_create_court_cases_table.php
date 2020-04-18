<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourtCasesTable extends Migration
{
    public function up()
    {
        Schema::create('court_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('case_name')->nullable();
            $table->string('case_number')->nullable();
            $table->decimal('awarded_value', 15, 2)->nullable();
            $table->decimal('proposed_value', 15, 2)->nullable();
            $table->date('closed_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
