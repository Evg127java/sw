<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Vehicle;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Seeder;

class FilmVehicleSeeder extends Seeder
{
    /**
     * @var FilmRepositoryInterface
     */
    protected FilmRepositoryInterface $filmRepository;
    /**
     * @var RepositoryInterface
     */
    protected $vehicleRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param FilmRepositoryInterface $filmRepository
     * @param Vehicle $vehicle
     * @return void
     */
    public function run(RepositoryInterface $repository, FilmRepositoryInterface $filmRepository, Vehicle $vehicle)
    {
        $this->filmRepository = $filmRepository;
        ($this->vehicleRepository = $repository)->setModel($vehicle);

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
