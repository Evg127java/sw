<?php


namespace App\Repositories\HomeworldRepository;


use App\Models\Homeworld;

class HomeworldRepositorySql implements HomeworldRepositoryInterface
{

    /**
     * Gets all instances from a storage
     * @return Homeworld[]
     */
    public function getAll()
    {
        return Homeworld::all();
    }

    /**
     * Add all passed instances to a storage
     * @param array $homeworldsSet
     */
    public function addAll(array $homeworldsSet)
    {
        Homeworld::insertOrIgnore($homeworldsSet);
    }

    /**
     * Gets instance's id by the specified parameter and its value
     * @param string $parameterName
     * @param string $parameterValue
     * @return int
     */
    public function getIdByParameter(string $parameterName, string $parameterValue)
    {
        return Homeworld::where($parameterName, $parameterValue)->firstOrFail()->id;
    }
}
