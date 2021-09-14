<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Specie;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

class FilmSpecieSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $filmRepository;
    /**
     * @var RepositoryInterface
     */
    protected $specieRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Film $film
     * @param Specie $specie
     * @return void
     */
    public function run(RepositoryInterface $repository, Film $film, Specie $specie)
    {
        ($this->filmRepository = $repository)->setModel($film);
        ($this->specieRepository = clone($repository))->setModel($specie);

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
