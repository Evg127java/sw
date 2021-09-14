<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Specie;
use App\Models\Starship;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

class PersonSpecieSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $personRepository;
    /**
     * @var RepositoryInterface
     */
    protected $specieRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Person $person
     * @param Specie $specie
     * @return void
     */
    public function run(RepositoryInterface $repository, Person $person, Specie $specie)
    {
        ($this->personRepository = $repository)->setModel($person);
        ($this->specieRepository = clone($repository))->setModel($specie);

        $apiAddress = config('app.speciesApiSource');
        $this->bindPeopleToSpecies($apiAddress);
    }

    /**
     * Binds people to starships as relations
     * @param $apiAddress
     */
    private function bindPeopleToSpecies($apiAddress)
    {
        $specieRequest = json_decode(file_get_contents($apiAddress, true));

        $species = $specieRequest->results;
        foreach ($species as $specie) {
            foreach ($specie->people as $personLink) {
                $specie = $this->specieRepository->getOneByColumnValue('name', $specie->name);
                $personId = preg_split('~\/~', $personLink)[5];
                $person = $this->personRepository->getOneById($personId);
                $specie->people()->save($person);
            }
        }
        if ($specieRequest->next) {
            $this->bindPeopleToSpecies($specieRequest->next);
        }
    }
}
