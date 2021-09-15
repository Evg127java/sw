<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Specie;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Seeder;

class FilmSpecieSeeder extends Seeder
{
    /**
     * @var FilmRepositoryInterface
     */
    protected FilmRepositoryInterface $filmRepository;
    /**
     * @var RepositoryInterface
     */
    protected $specieRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param FilmRepositoryInterface $filmRepository
     * @param Specie $specie
     * @return void
     */
    public function run(RepositoryInterface $repository, FilmRepositoryInterface $filmRepository, Specie $specie)
    {
        $this->filmRepository = $filmRepository;
        ($this->specieRepository = $repository)->setModel($specie);

        $apiAddress = config('app.speciesApiSource');
        $this->bindFilmsToSpecies($apiAddress);
    }

    /**
     * Binds films to starships as relations
     * @param $apiAddress
     */
    private function bindFilmsToSpecies($apiAddress)
    {
        $specieRequest = json_decode(file_get_contents($apiAddress, true));

        $species = $specieRequest->results;
        foreach ($species as $specie) {
            foreach ($specie->films as $filmLink) {
                $specie = $this->specieRepository->getOneByColumnValue('name', $specie->name);
                $filmId = preg_split('~\/~', $filmLink)[5];
                $film = $this->filmRepository->getOneById($filmId);
                $specie->films()->attach($film);
            }
        }
        if ($specieRequest->next) {
            $this->bindFilmsToSpecies($specieRequest->next);
        }
    }
}
