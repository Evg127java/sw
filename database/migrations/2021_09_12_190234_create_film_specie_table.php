<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmSpecieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_specie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->unsignedBigInteger('specie_id');
            $table->foreign('specie_id')->references('id')->on('species')->onDelete('cascade');
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
        Schema::dropIfExists('film_specie');
    }
}
