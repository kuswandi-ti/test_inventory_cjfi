<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoccounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_counter', function (Blueprint $table) {
            $table->string('transaction_name');
            $table->integer('transaction_year');
            $table->integer('transaction_month');
            $table->integer('transaction_current_docno');
            $table->string('transaction_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_counter');
    }
}
