<?php

namespace Database\Seeders;


use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\SpecieRepository\SpecieRepositoryInterface;
use DB;
use Http;
use Illuminate\Database\Seeder;
use function PHPUnit\Framework\isEmpty;

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
    private string $tableName = 'person_specie';

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
            $dateTime = date('Y-m-d H:i:s', strtotime('now'));

            foreach ($request->results as $person) {
                $dataToInsert = [];
                foreach ($person->species as $specieLink) {
                    $person = $this->personRepository->getOneByName($person->name);
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
