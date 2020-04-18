<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->unsignedInteger('client_id');
            $table->foreign('client_id', 'client_fk_1332399')->references('id')->on('crm_customers');
            $table->unsignedInteger('notes_id')->nullable();
            $table->foreign('notes_id', 'notes_fk_1332470')->references('id')->on('crm_notes');
            $table->unsignedInteger('document_id')->nullable();
            $table->foreign('document_id', 'document_fk_1332627')->references('id')->on('crm_documents');
            $table->unsignedInteger('courthouse_id')->nullable();
            $table->foreign('courthouse_id', 'courthouse_fk_1332760')->references('id')->on('courthouses');
        });

    }
}
