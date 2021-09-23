<?php

namespace Database\Seeders;


use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\SpecieRepository\SpecieRepositoryInterface;
use DB;
use Http;
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

        $apiAddress = config('app.peopleApiSource');
        $this->bindPeopleToSpecies($apiAddress);
    }

    /**
     * Binds people to species as relations
     * @param $apiAddress
     */
    private function bindPeopleToSpecies($apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));

            foreach ($request->results as $person) {
                $personId = $this->personRepository->getIdByName($person->name);
                $dataToUpdate = [];
                foreach ($person->species as $specieLink) {
                    $specieId = preg_split('~/~', $specieLink)[config('app.linkPartNumber')];
                    $dataToUpdate[] = ['id' => $personId, 'specie_id' => $specieId];
                }
                $this->personRepository->updateMany($dataToUpdate);
            }
            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
