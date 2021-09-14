<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Starship;
use App\Models\Vehicle;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $vehicleRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Vehicle $vehicle
     * @return void
     */
    public function run(RepositoryInterface $repository, Vehicle $vehicle)
    {
        ($this->vehicleRepository = clone($repository))->setModel($vehicle);

        /* API address from where to get data */
        $apiAddress = config('app.vehiclesApiSource');

        /* Seeding running */
        $this->seedVehicles($apiAddress);
    }

    /**
     * Seeds vehicles to vehicles table in DB
     * @param string $apiRequest
     * @param array $vehiclesToSeed
     */
    private function seedVehicles(string $apiRequest, array $vehiclesToSeed = [])
    {
        $vehicleRequest = json_decode(file_get_contents($apiRequest, true));

        $vehicles = $vehicleRequest->results;
        foreach ($vehicles as $vehicle) {

            $vehiclesToSeed[] =
                [
                    'name' => $vehicle->name,
                    'model' => $vehicle->model,
                    'manufacturer' => $vehicle->manufacturer,
                    'cost_in_credits' => $vehicle->cost_in_credits,
                    'length' => $vehicle->length,
                    'max_atmosphering_speed' => $vehicle->max_atmosphering_speed,
                    'passengers' => $vehicle->passengers,
                    'crew' => $vehicle->crew,
                    'cargo_capacity' => $vehicle->cargo_capacity,
                    'consumables' => $vehicle->consumables,
                    'vehicle_class' => $vehicle->vehicle_class,
                    'created_at' => date('Y-m-d H:i:s', strtotime($vehicle->created)),
                    'updated_at' => date('Y-m-d H:i:s', strtotime($vehicle->edited)),
                    'url' => $vehicle->url,
                ];
        }
        /* If there are more than one pages at API resource */
        if ($vehicleRequest->next) {
            $this->seedVehicles($vehicleRequest->next, $vehiclesToSeed);
        } else {
            $this->vehicleRepository->addAll($vehiclesToSeed);
        }
    }
}
