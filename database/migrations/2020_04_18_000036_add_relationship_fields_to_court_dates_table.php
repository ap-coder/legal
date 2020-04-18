<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourtDatesTable extends Migration
{
    public function up()
    {
        Schema::table('court_dates', function (Blueprint $table) {
            $table->unsignedInteger('courthouse_id')->nullable();
            $table->foreign('courthouse_id', 'courthouse_fk_254310')->references('id')->on('courthouses');
            $table->unsignedInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_1332756')->references('id')->on('crm_customers');
        });

    }
}
