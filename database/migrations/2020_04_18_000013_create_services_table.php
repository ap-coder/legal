<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('service_text')->nullable();
            $table->longText('service_text_2')->nullable();
            $table->longText('excerpt')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('facebook_title')->nullable();
            $table->string('facebook_desc')->nullable();
            $table->string('icon_class')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
