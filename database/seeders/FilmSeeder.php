<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Repositories\FilmRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class FilmSeeder
 * @package Database\Seeders
 */
class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* API address from where to get data */
        $apiAddress = 'https://swapi.dev/api/films';

        /* Seeding running */
        $this->seedFilms($apiAddress);
    }

    /**
     * Seeds films to films table in DB
     * @param string $apiAddress  address from where to get data
     * @param array $filmsToSeed  films array to seed
     */
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
        /* If there is more than one page at API resource */
        if ($request->next) {
            $this->seedFilms($request->next, $filmsToSeed);
        } else {
            $filmRepository->addAll($filmsToSeed);
        }
    }
}
