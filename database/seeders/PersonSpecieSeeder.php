<?php

namespace Database\Seeders;


use App\Repositories\PersonRepository\PersonRepositoryInterface;
use DB;
use Http;
use Illuminate\Database\Seeder;

class PersonSpecieSeeder extends Seeder
{
    /**
     * @var PersonRepositoryInterface
     */
    private PersonRepositoryInterface $personRepository;
    private string $tableName = 'person_specie';

    /**
     * Run the database seeds.
     *
     * @param PersonRepositoryInterface $personRepository
     * @return void
     */
    public function run(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;

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
            $dateTime = date('Y-m-d H:i:s', strtotime('now'));

            foreach ($request->results as $personFromApi) {
                $dataToInsert = [];
                foreach ($personFromApi->species as $specieLink) {
                    $person = $this->personRepository->getOneByName($personFromApi->name);
                    $specieId = preg_split('~/~', $specieLink)[config('app.linkPartNumber')];
                    $dataToInsert[] = [
                        'person_id' => $person->getId(),
                        'specie_id' => $specieId,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
                DB::table($this->tableName)->insertOrIgnore($dataToInsert);
            }
            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
