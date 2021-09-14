<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Starship;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Seeder;

class FilmStarshipSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $filmRepository;
    /**
     * @var RepositoryInterface
     */
    protected $starshipRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Film $film
     * @param Starship $starship
     * @return void
     */
    public function run(RepositoryInterface $repository, Film $film, Starship $starship)
    {
        ($this->filmRepository = $repository)->setModel($film);
        ($this->starshipRepository = clone($repository))->setModel($starship);

        $apiAddress = config('app.starshipsApiSource');
        $this->bindFilmsToStarships($apiAddress);
    }

    /**
     * Binds films to starships as relations
     * @param $apiAddress
     */
    private function bindFilmsToStarships($apiAddress)
    {
        $starshipRequest = json_decode(file_get_contents($apiAddress, true));

        $starships = $starshipRequest->results;
        foreach ($starships as $starship) {
            foreach ($starship->films as $filmLink) {
                $starship = $this->starshipRepository->getOneByColumnValue('name', $starship->name);
                $filmId = preg_split('~\/~', $filmLink)[5];
                $film = $this->filmRepository->getOneById($filmId);
                $starship->films()->attach($film);
            }
        }
        if ($starshipRequest->next) {
            $this->bindFilmsToStarships($starshipRequest->next);
        }
    }
}
