<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTagPostPivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_tag_post', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->foreign('post_id', 'post_id_fk_254341')->references('id')->on('posts')->onDelete('cascade');
            $table->unsignedInteger('content_tag_id');
            $table->foreign('content_tag_id', 'content_tag_id_fk_254341')->references('id')->on('content_tags')->onDelete('cascade');
        });

    }
}
