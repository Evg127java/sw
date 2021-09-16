<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Specie;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\SpecieRepository\SpecieRepositoryInterface;
use Illuminate\Database\Seeder;

class FilmSpecieSeeder extends Seeder
{
    /**
     * @var FilmRepositoryInterface
     */
    protected FilmRepositoryInterface $filmRepository;
    /**
     * @var SpecieRepositoryInterface
     */
    protected SpecieRepositoryInterface $specieRepository;

    /**
     * Run the database seeds.
     *
     * @param SpecieRepositoryInterface $specieRepository
     * @param FilmRepositoryInterface $filmRepository
     * @return void
     */
    public function run(SpecieRepositoryInterface $specieRepository, FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->specieRepository = $specieRepository;

        $apiAddress = config('app.speciesApiSource');
        $this->bindFilmsToSpecies($apiAddress);
    }

    /**
     * Binds films to species as relations
     * @param $apiAddress
     */
    private function bindFilmsToSpecies($apiAddress)
    {

        $specieRequest = json_decode(\Http::get($apiAddress));

        $species = $specieRequest->results;
        foreach ($species as $specie) {
            foreach ($specie->films as $filmLink) {
                $specie = $this->specieRepository->getSpecieByParameterAndValue('name', $specie->name);
                $filmId = preg_split('~\/~', $filmLink)[config('app.linkPartNumber')];
                $film = $this->filmRepository->getOneById($filmId);
                $specie->films()->attach($film);
            }
        }
        if ($specieRequest->next) {
            $this->bindFilmsToSpecies($specieRequest->next);
        }
    }
}
