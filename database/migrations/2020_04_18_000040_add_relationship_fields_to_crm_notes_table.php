<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCrmNotesTable extends Migration
{
    public function up()
    {
        Schema::table('crm_notes', function (Blueprint $table) {
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id', 'customer_fk_254083')->references('id')->on('crm_customers');
            $table->unsignedInteger('court_case_id')->nullable();
            $table->foreign('court_case_id', 'court_case_fk_1332780')->references('id')->on('court_cases');
        });

    }
}
