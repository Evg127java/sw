<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Starship;
use App\Models\Vehicle;
use App\Repositories\RepositoryInterface;
use App\Repositories\VehicleRepository\VehicleRepositoryInterface;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * @var VehicleRepositoryInterface
     */
    protected VehicleRepositoryInterface $vehicleRepository;

    /**
     * Run the database seeds.
     *
     * @param VehicleRepositoryInterface $vehicleRepository
     * @return void
     */
    public function run(VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;

        /* API address from where to get data */
        $apiAddress = config('app.vehiclesApiSource');

        /* Seeding running */
        $this->seedVehicles($apiAddress);
    }

    /**
     * Seeds vehicles to vehicles table in DB
     * @param string $apiRequest
     */
    private function seedVehicles(string $apiRequest)
    {
        $vehiclesToSeed = [];
        $vehicleRequest = json_decode(\Http::get($apiRequest));

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
        $this->vehicleRepository->addAll($vehiclesToSeed);
        /* If there are more than one pages at API resource */
        if ($vehicleRequest->next) {
            $this->seedVehicles($vehicleRequest->next);
        }
    }
}
