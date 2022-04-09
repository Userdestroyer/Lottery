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
        Schema::create('draw_types', function (Blueprint $table) {
            $table->bigIncrements('draw_type_id');
            $table->string('draw_type_name');
            $table->integer('draw_type_volume');
            $table->integer('draw_type_min_of_values');
            $table->integer('draw_type_max_of_values');
            $table->string('draw_type_image')->nullable();
            $table->text('draw_type_description');
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
        Schema::dropIfExists('draw_types');
    }
};
