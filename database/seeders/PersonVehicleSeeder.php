<?php

namespace Database\Seeders;

use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\VehicleRepository\VehicleRepositoryInterface;
use DB;
use Http;
use Illuminate\Database\Seeder;

class PersonVehicleSeeder extends Seeder
{
    /**
     * @var PersonRepositoryInterface
     */
    private PersonRepositoryInterface $personRepository;
    private string $tableName = 'person_vehicle';

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
        $this->bindPeopleToVehicles($apiAddress);
    }

    /**
     * Binds people to vehicles as relations
     * @param $apiAddress
     */
    private function bindPeopleToVehicles($apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $dateTime = date('Y-m-d H:i:s', strtotime('now'));

            foreach ($request->results as $personFromApi) {
                $dataToInsert = [];
                foreach ($personFromApi->vehicles as $vehicleLink) {
                    $person = $this->personRepository->getOneByName($personFromApi->name);
                    $vehicleId = preg_split('~/~', $vehicleLink)[config('app.linkPartNumber')];
                    $dataToInsert[] = [
                        'person_id' => $person->getId(),
                        'vehicle_id' => $vehicleId,
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
