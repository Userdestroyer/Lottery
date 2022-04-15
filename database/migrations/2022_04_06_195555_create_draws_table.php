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
        Schema::create('draws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('draw_types')->onDelete('cascade');
            $table->json('values')->nullable();
            $table->integer('received');
            $table->integer('paid');
            $table->boolean('is_played');
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
        Schema::dropIfExists('draws');
    }
};
