<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Membuat table 'pizzas' pada database.
         * 
         * Made by @stefanadisurya & @ChristopherIrvine
         */
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->integer('price');
            $table->string('description');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
}
