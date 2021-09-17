<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Starship;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\StarshipRepository\StarshipRepositoryInterface;
use Illuminate\Database\Seeder;

class FilmStarshipSeeder extends Seeder
{
    /**
     * @var FilmRepositoryInterface
     */
    protected FilmRepositoryInterface $filmRepository;
    /**
     * @var StarshipRepositoryInterface
     */
    protected StarshipRepositoryInterface $starshipRepository;

    /**
     * Run the database seeds.
     *
     * @param StarshipRepositoryInterface $starshipRepository
     * @param FilmRepositoryInterface $filmRepository
     * @return void
     */
    public function run(StarshipRepositoryInterface $starshipRepository, FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->starshipRepository = $starshipRepository;

        $apiAddress = config('app.starshipsApiSource');
        $this->bindFilmsToStarships($apiAddress);
    }

    /**
     * Binds films to starships as relations
     * @param $apiAddress
     */
    private function bindFilmsToStarships($apiAddress)
    {
        $starshipRequest = json_decode(\Http::get($apiAddress));

        $starships = $starshipRequest->results;
        foreach ($starships as $starship) {
            foreach ($starship->films as $filmLink) {
                $starship = $this->starshipRepository->getOneByParameter('name', $starship->name);
                $filmId = preg_split('~\/~', $filmLink)[config('app.linkPartNumber')];
                $film = $this->filmRepository->getOneById($filmId);
                $starship->films()->attach($film);
            }
        }
        if ($starshipRequest->next) {
            $this->bindFilmsToStarships($starshipRequest->next);
        }
    }
}
