<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Vehicle;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\VehicleRepository\VehicleRepositoryInterface;
use Illuminate\Database\Seeder;

class PersonVehicleSeeder extends Seeder
{
    /**
     * @var PersonRepositoryInterface
     */
    protected PersonRepositoryInterface $personRepository;
    /**
     * @var VehicleRepositoryInterface
     */
    protected VehicleRepositoryInterface $vehicleRepository;

    /**
     * Run the database seeds.
     *
     * @param VehicleRepositoryInterface $vehicleRepository
     * @param PersonRepositoryInterface $personRepository
     * @return void
     */
    public function run(VehicleRepositoryInterface $vehicleRepository, PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
        $this->vehicleRepository = $vehicleRepository;

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
                $vehicle = $this->vehicleRepository->getVehicleByParameterAndValue('name', $vehicle->name);
                $pilotId = preg_split('~\/~', $pilotLink)[5];
                $pilot = $this->personRepository->getPersonById($pilotId);
                $vehicle->people()->attach($pilot);
            }
        }
        if ($vehicleRequest->next) {
            $this->bindPeopleToVehicles($vehicleRequest->next);
        }
    }
}
