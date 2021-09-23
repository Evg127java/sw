<?php

namespace Database\Seeders;

use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\StarshipRepository\StarshipRepositoryInterface;
use DB;
use Http;
use Illuminate\Database\Seeder;

class PersonStarshipSeeder extends Seeder
{
    /**
     * @var PersonRepositoryInterface
     */
    protected PersonRepositoryInterface $personRepository;
    /**
     * @var StarshipRepositoryInterface
     */
    protected StarshipRepositoryInterface $starshipRepository;
    private string $tableName = 'person_starship';

    /**
     * Run the database seeds.
     *
     * @param PersonRepositoryInterface $personRepository
     * @param StarshipRepositoryInterface $starshipRepository
     * @return void
     */
    public function run(PersonRepositoryInterface $personRepository, StarshipRepositoryInterface $starshipRepository)
    {
        $this->personRepository = $personRepository;
        $this->starshipRepository = $starshipRepository;

        $apiAddress = config('app.peopleApiSource');
        $this->bindPeopleToStarships($apiAddress);
    }

    /**
     * Binds people to starships as relations
     * @param $apiAddress
     */
    private function bindPeopleToStarships($apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $dateTime = date('Y-m-d H:i:s', strtotime('now'));

            foreach ($request->results as $person) {
                $dataToInsert = [];
                foreach ($person->starships as $starshipLink) {
                    $person = $this->personRepository->getOneByName($person->name);
                    $starshipId = preg_split('~/~', $starshipLink)[config('app.linkPartNumber')];
                    $dataToInsert[] = [
                        'person_id' => $person->getId(),
                        'starship_id' => $starshipId,
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
