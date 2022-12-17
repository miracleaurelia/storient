<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('TransactionID');
            $table->foreign('TransactionID')->on('transaction_headers')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('BookID');
            $table->foreign('BookID')->on('books')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
