<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('totalPrice');
            $table->string('paymentProof');
            $table->boolean('isApproved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_headers');
    }
}
