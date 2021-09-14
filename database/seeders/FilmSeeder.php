<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class FilmSeeder
 * @package Database\Seeders
 */
class FilmSeeder extends Seeder
{
    protected $filmRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Film $film
     * @return void
     */
    public function run(RepositoryInterface $repository, Film $film)
    {
        ($this->filmRepository = $repository)->setModel($film);

        /* API address from where to get data */
        $apiAddress = config('app.filmsApiSource');

        /* Seeding running */
        $this->seedFilms($apiAddress);
    }

    /**
     * Seeds films to films table in DB
     * @param string $apiAddress address from where to get data
     * @param array $filmsToSeed films array to seed
     */
    private function seedFilms(string $apiAddress, array $filmsToSeed = [])
    {
        $request = json_decode(file_get_contents($apiAddress, true));

        $films = $request->results;
        foreach ($films as $film) {
            $filmsToSeed[] = ['title' => $film->title];
        }
        /* If there is more than one page at API resource */
        if ($request->next) {
            $this->seedFilms($request->next, $filmsToSeed);
        } else {
            $this->filmRepository->addAll($filmsToSeed);
        }
    }
}
