<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadertransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Membuat table 'headerTransactions' pada database.
         * 
         * Made by @stefanadisurya & @ChristopherIrvine
         */
        Schema::create('headertransactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserId');
            $table->foreign('UserId')->references('id')->on('users');
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
        Schema::dropIfExists('headertransactions');
    }
}
