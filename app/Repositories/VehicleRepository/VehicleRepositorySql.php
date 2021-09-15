<?php


namespace App\Repositories\VehicleRepository;


use App\Models\Vehicle;

class VehicleRepositorySql implements VehicleRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $vehiclesSet
     */
    public function addAll(array $vehiclesSet)
    {
        Vehicle::insertOrIgnore($vehiclesSet);
    }

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getVehicleByParameterAndValue(string $parameter, $value)
    {
        return Vehicle::firstWhere($parameter, $value);
    }
}
