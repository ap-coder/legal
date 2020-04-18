<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTagServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_tag_service', function (Blueprint $table) {
            $table->unsignedInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_254455')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedInteger('content_tag_id');
            $table->foreign('content_tag_id', 'content_tag_id_fk_254455')->references('id')->on('content_tags')->onDelete('cascade');
        });

    }
}
