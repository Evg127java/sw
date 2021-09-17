<?php


namespace App\Repositories\VehicleRepository;


use App\Models\Vehicle;

class VehicleRepositorySql implements VehicleRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $vehicles
     */
    public function saveMany(array $vehicles)
    {
        Vehicle::insertOrIgnore($vehicles);
    }

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getOneByParameter(string $parameter, $value)
    {
        return Vehicle::firstWhere($parameter, $value);
    }
}
