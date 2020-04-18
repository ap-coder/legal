<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountCourtDatePivotTable extends Migration
{
    public function up()
    {
        Schema::create('account_court_date', function (Blueprint $table) {
            $table->unsignedInteger('account_id');
            $table->foreign('account_id', 'account_id_fk_1332400')->references('id')->on('accounts')->onDelete('cascade');
            $table->unsignedInteger('court_date_id');
            $table->foreign('court_date_id', 'court_date_id_fk_1332400')->references('id')->on('court_dates')->onDelete('cascade');
        });

    }
}
