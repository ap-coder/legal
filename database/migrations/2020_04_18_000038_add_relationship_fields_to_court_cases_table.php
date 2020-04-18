<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourtCasesTable extends Migration
{
    public function up()
    {
        Schema::table('court_cases', function (Blueprint $table) {
            $table->unsignedInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_254239')->references('id')->on('crm_customers');
        });

    }
}
