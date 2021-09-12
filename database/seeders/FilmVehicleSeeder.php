<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Vehicle;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

class FilmVehicleSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $filmRepository;
    /**
     * @var RepositoryInterface
     */
    protected $vehicleRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Film $film
     * @param Vehicle $vehicle
     * @return void
     */
    public function run(RepositoryInterface $repository, Film $film, Vehicle $vehicle)
    {
        ($this->filmRepository = $repository)->setModel($film);
        ($this->vehicleRepository = clone($repository))->setModel($vehicle);

        $apiAddress = config('app.apiBaseSource').'vehicles';
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
                $vehicle = $this->vehicleRepository->getOneByColumnValue('name', $vehicle->name);
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
