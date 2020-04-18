<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourthousesTable extends Migration
{
    public function up()
    {
        Schema::create('courthouses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('courthouse_name')->nullable();
            $table->string('courthouse_city')->nullable();
            $table->string('courthouse_state')->nullable();
            $table->string('courthouse_zip')->nullable();
            $table->string('googlemaps_url')->nullable();
            $table->string('courthouse_street')->nullable();
            $table->string('courthouse_street_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
