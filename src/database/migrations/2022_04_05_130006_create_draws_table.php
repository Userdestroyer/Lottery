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
            $table->id('draw_id');
            $table->string('draw_type');
            $table->integer('draw_number');
            $table->string('draw_values');
            $table->integer('draw_number_of_tickets');
            $table->decimal('draw_income');
            $table->decimal('draw_pot');
            $table->datetime('draw_datetime');
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
