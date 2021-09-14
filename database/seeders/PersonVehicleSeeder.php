<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Vehicle;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

class PersonVehicleSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $personRepository;
    /**
     * @var RepositoryInterface
     */
    protected $vehicleRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Person $person
     * @param Vehicle $vehicle
     * @return void
     */
    public function run(RepositoryInterface $repository, Person $person, Vehicle $vehicle)
    {
        ($this->personRepository = $repository)->setModel($person);
        ($this->vehicleRepository = clone($repository))->setModel($vehicle);

        $apiAddress = config('app.vehiclesApiSource');
        $this->bindPeopleToVehicles($apiAddress);
    }

    /**
     * Binds people to vehicles as relations
     * @param $apiAddress
     */
    private function bindPeopleToVehicles($apiAddress)
    {
        $vehicleRequest = json_decode(file_get_contents($apiAddress, true));

        $vehicles = $vehicleRequest->results;
        foreach ($vehicles as $vehicle) {
            foreach ($vehicle->pilots as $pilotLink) {
                $vehicle = $this->vehicleRepository->getOneByColumnValue('name', $vehicle->name);
                $pilotId = preg_split('~\/~', $pilotLink)[5];
                $pilot = $this->personRepository->getOneById($pilotId);
                $vehicle->people()->attach($pilot);
            }
        }
        if ($vehicleRequest->next) {
            $this->bindPeopleToVehicles($vehicleRequest->next);
        }
    }
}
