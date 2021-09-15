<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Vehicle;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\VehicleRepository\VehicleRepositoryInterface;
use Illuminate\Database\Seeder;

class FilmVehicleSeeder extends Seeder
{
    /**
     * @var FilmRepositoryInterface
     */
    protected FilmRepositoryInterface $filmRepository;
    /**
     * @var VehicleRepositoryInterface
     */
    protected VehicleRepositoryInterface $vehicleRepository;

    /**
     * Run the database seeds.
     *
     * @param VehicleRepositoryInterface $vehicleRepository
     * @param FilmRepositoryInterface $filmRepository
     * @return void
     */
    public function run(VehicleRepositoryInterface $vehicleRepository, FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->vehicleRepository = $vehicleRepository;

        $apiAddress = config('app.vehiclesApiSource');
        $this->bindFilmsToVehicles($apiAddress);
    }

    /**
     * Binds films to vehicles as relations
     * @param $apiAddress
     */
    private function bindFilmsToVehicles($apiAddress)
    {
        $VehicleRequest = json_decode(file_get_contents($apiAddress, true));

        $vehicles = $VehicleRequest->results;
        foreach ($vehicles as $vehicle) {
            foreach ($vehicle->films as $filmLink) {
                $vehicle = $this->vehicleRepository->getVehicleByParameterAndValue('name', $vehicle->name);
                $filmId = preg_split('~\/~', $filmLink)[5];
                $film = $this->filmRepository->getOneById($filmId);
                $vehicle->films()->attach($film);
            }
        }
        if ($VehicleRequest->next) {
            $this->bindFilmsToVehicles($VehicleRequest->next);
        }
    }
}
