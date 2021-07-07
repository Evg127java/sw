<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Repositories\FilmRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apiAddress = 'https://swapi.dev/api/films';
        $this->seedFilms($apiAddress);

    }

    private function seedFilms(string $apiAddress, array $filmsToSeed = [])
    {
        $filmRepository = new FilmRepository();
        $request = json_decode(file_get_contents($apiAddress, true));

        $films = $request->results;
        foreach ($films as $film) {
            $filmsToSeed[] =
                [
                    'title' => $film->title,
                ];
        }
        if ($request->next) {
            $this->seedFilms($request->next, $filmsToSeed);
        } else {
            $filmRepository->addAll($filmsToSeed);
        }
    }
}
