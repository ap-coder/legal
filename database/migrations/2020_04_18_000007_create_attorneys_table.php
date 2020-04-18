<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttorneysTable extends Migration
{
    public function up()
    {
        Schema::create('attorneys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('specialty')->nullable();
            $table->string('intro')->nullable();
            $table->longText('content_area')->nullable();
            $table->longText('content_area_2')->nullable();
            $table->longText('notes')->nullable();
            $table->longText('bio_area')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('other_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
