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
            $table->id('ticket_id');
            $table->string('ticket_type');
            $table->integer('ticket_draw_number');
            $table->integer('ticket_number');
            $table->json('ticket_values');
            $table->decimal('ticket_price');
            $table->boolean('ticket_is_winner');
            $table->decimal('ticket_winning_sum');
            $table->foreignId('ticket_user_id')->unsigned();
            $table->foreign('ticket_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamp('ticket_purchase_date');
            $table->datetime('ticket_play_datetime')->nullable();
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
