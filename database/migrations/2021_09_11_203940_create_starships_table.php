<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('manufacturer');
            $table->integer('cost_in_credits');
            $table->double('length');
            $table->integer('max_atmosphering_speed');
            $table->string('passengers');
            $table->string('crew');
            $table->integer('cargo_capacity');
            $table->string('consumables');
            $table->double('hyperdrive_rating');
            $table->integer('MGLT');
            $table->string('starship_class');
            $table->string('url');
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
        Schema::dropIfExists('starships');
    }
}
