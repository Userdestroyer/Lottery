<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('draw_types')->onDelete('cascade');
            $table->foreignId('draw_id')->unsigned();
            $table->foreign('draw_id')->references('id')->on('draws')->onDelete('cascade');
            $table->integer('number');
            $table->json('values');
            $table->integer('price');
            $table->boolean('is_winner');
            $table->integer('matches')->nullable();
            $table->integer('number_of_matches')->nullable();
            $table->integer('winning_sum')->nullable();
            $table->integer('balance')->nullable();
            $table->foreignId('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tickets');
    }
};
