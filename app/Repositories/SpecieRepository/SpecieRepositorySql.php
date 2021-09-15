<?php


namespace App\Repositories\SpecieRepository;


use App\Models\Specie;

class SpecieRepositorySql implements SpecieRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $vehiclesSet
     */
    public function addAll(array $vehiclesSet)
    {
        Specie::insertOrIgnore($vehiclesSet);
    }

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getSpecieByParameterAndValue(string $parameter, $value)
    {
        return Specie::firstWhere($parameter, $value);
    }
}
