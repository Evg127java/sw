<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenderSeeder::class);
        $this->call(FilmSeeder::class);
        $this->call(HomeworldSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(FilmPersonSeeder::class);
    }
}
