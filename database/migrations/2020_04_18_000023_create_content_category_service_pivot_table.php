<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentCategoryServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_category_service', function (Blueprint $table) {
            $table->unsignedInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_254454')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedInteger('content_category_id');
            $table->foreign('content_category_id', 'content_category_id_fk_254454')->references('id')->on('content_categories')->onDelete('cascade');
        });

    }
}
