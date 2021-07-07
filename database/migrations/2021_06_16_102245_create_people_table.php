<?php

use Database\Seeders\PersonSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('height');
            $table->string('mass');
            $table->string('hair_color');
            $table->string('birth_year');
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('homeworld_id');
            $table->string('url');
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => PersonSeeder::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
