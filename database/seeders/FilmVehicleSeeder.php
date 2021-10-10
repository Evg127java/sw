<?php

namespace Database\Seeders;

use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\VehicleRepository\VehicleRepositoryInterface;
use DB;
use Http;
use Illuminate\Database\Seeder;

class FilmVehicleSeeder extends Seeder
{
    /**
     * @var VehicleRepositoryInterface
     */
    private VehicleRepositoryInterface $vehicleRepository;

    /**
     * Run the database seeds.
     *
     * @param VehicleRepositoryInterface $vehicleRepository
     * @return void
     */
    public function run(VehicleRepositoryInterface $vehicleRepository)
    {
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
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $dateTime = date('Y-m-d H:i:s', strtotime('now'));

            foreach ($request->results as $vehicleFromApi) {
                $dataToInsert = [];
                foreach ($vehicleFromApi->films as $filmLink) {
                    $vehicle = $this->vehicleRepository->getOneByName($vehicleFromApi->name);
                    $filmId = preg_split('~/~', $filmLink)[config('app.linkPartNumber')];
                    $dataToInsert[] = [
                        'vehicle_id' => $vehicle->getId(),
                        'film_id' => $filmId,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
                DB::table('film_vehicle')->insertOrIgnore($dataToInsert);
            }
            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
