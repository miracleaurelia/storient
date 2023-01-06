<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('id');
            $table->string('image');
            $table->string('bookTitle');
            $table->string('author');
            $table->double('price');
            $table->text('description');
            $table->integer('pageCount');
            $table->integer('releaseYear');
            $table->string('preview');
            $table->integer('is_deleted')->default(0);
            $table->integer('buy_stock')->default(1);
            $table->integer('borrow_stock')->default(1);
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
        Schema::dropIfExists('books');
    }
}
