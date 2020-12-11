<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailtransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Membuat table 'detailtransactions' pada database.
         * 
         * Made by @stefanadisurya & @ChristopherIrvine
         */
        Schema::create('detailtransactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PizzaId');
            $table->unsignedBigInteger('TransactionId');
            $table->integer('Quantity')->unsigned();
            $table->foreign('PizzaId')->references('id')->on('pizzas');
            $table->foreign('TransactionId')->references('id')->on('headertransactions');
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
        Schema::dropIfExists('detailtransactions');
    }
}
