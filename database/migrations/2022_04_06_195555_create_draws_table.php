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
            $table->bigIncrements('draw_id');
            $table->foreignId('draw_type_id')->unsigned();
            $table->foreign('draw_type_id')->references('draw_type_id')->on('draw_types')->onDelete('cascade');
            $table->json('draw_values');
            $table->integer('draw_pot');
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
