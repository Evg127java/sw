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
        $this->call([
            GenderSeeder::class,
            FilmSeeder::class,
            HomeworldSeeder::class,
            PersonSeeder::class,
            FilmPersonSeeder::class,
            StarshipSeeder::class,
            FilmStarshipSeeder::class,
            PersonStarshipSeeder::class,
            VehicleSeeder::class,
            FilmVehicleSeeder::class,
            PersonVehicleSeeder::class,
            SpecieSeeder::class,
            FilmSpecieSeeder::class,
            PersonSpecieSeeder::class,
        ]);
    }
}
