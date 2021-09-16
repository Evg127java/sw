<?php


namespace App\Repositories\SpecieRepository;


use App\Models\Specie;

class SpecieRepositorySql implements SpecieRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $speciesSet
     */
    public function addAll(array $speciesSet)
    {
        Specie::insertOrIgnore($speciesSet);
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
