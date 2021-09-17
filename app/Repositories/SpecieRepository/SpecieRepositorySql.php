<?php


namespace App\Repositories\SpecieRepository;


use App\Models\Specie;

class SpecieRepositorySql implements SpecieRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $species
     */
    public function saveMany(array $species)
    {
        Specie::insertOrIgnore($species);
    }

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getOneByParameter(string $parameter, $value)
    {
        return Specie::firstWhere($parameter, $value);
    }
}
