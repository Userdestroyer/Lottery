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
        Schema::create('prize_charts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('draw_type_id')->nullable()->constrained('draw_types');
            $table->integer('1_match_level')->nullable();
            $table->integer('2_match_level')->nullable();
            $table->integer('3_match_level')->nullable();
            $table->integer('4_match_level')->nullable();
            $table->integer('5_match_level')->nullable();
            $table->integer('6_match_level')->nullable();
            $table->integer('7_match_level')->nullable();
            $table->integer('8_match_level')->nullable();
            $table->integer('9_match_level')->nullable();
            $table->integer('10_match_level')->nullable();
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
        Schema::dropIfExists('prize_charts');
    }
};
