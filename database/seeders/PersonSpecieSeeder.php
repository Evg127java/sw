<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Specie;
use App\Models\Starship;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\SpecieRepository\SpecieRepositoryInterface;
use Illuminate\Database\Seeder;

class PersonSpecieSeeder extends Seeder
{
    /**
     * @var PersonRepositoryInterface
     */
    protected PersonRepositoryInterface $personRepository;
    /**
     * @var SpecieRepositoryInterface
     */
    protected SpecieRepositoryInterface $specieRepository;

    /**
     * Run the database seeds.
     *
     * @param SpecieRepositoryInterface $specieRepository
     * @param PersonRepositoryInterface $personRepository
     * @return void
     */
    public function run(SpecieRepositoryInterface $specieRepository, PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
        $this->specieRepository = $specieRepository;

        $apiAddress = config('app.speciesApiSource');
        $this->bindPeopleToSpecies($apiAddress);
    }

    /**
     * Binds people to starships as relations
     * @param $apiAddress
     */
    private function bindPeopleToSpecies($apiAddress)
    {
        $specieRequest = json_decode(\Http::get($apiAddress));

        $species = $specieRequest->results;
        foreach ($species as $specie) {
            foreach ($specie->people as $personLink) {
                $specie = $this->specieRepository->getSpecieByParameterAndValue('name', $specie->name);
                $personId = preg_split('~\/~', $personLink)[config('app.linkPartNumber')];
                $person = $this->personRepository->getPersonById($personId);
                $specie->people()->save($person);
            }
        }
        if ($specieRequest->next) {
            $this->bindPeopleToSpecies($specieRequest->next);
        }
    }
}
