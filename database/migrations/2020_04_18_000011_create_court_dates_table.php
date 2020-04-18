<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourtDatesTable extends Migration
{
    public function up()
    {
        Schema::create('court_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('courtdate')->nullable();
            $table->longText('needed')->nullable();
            $table->longText('outcome')->nullable();
            $table->string('docket_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
