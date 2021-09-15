<?php


namespace App\Repositories\GenderRepository;


use App\Models\Gender;

class GenderRepositorySql implements GenderRepositoryInterface
{
    /**
     * Gets all instances from a storage
     * @return Gender[]
     */
    public function getAll()
    {
        return Gender::all();
    }

    /**
     * Add all passed instances to a storage
     * @param array $gendersSet
     */
    public function addAll(array $gendersSet)
    {
        Gender::insertOrIgnore($gendersSet);
    }

    /**
     * Gets instance's id by the specified parameter and its value
     * @param string $parameterName
     * @param string $parameterValue
     * @return int
     */
    public function getIdByParameter(string $parameterName, string $parameterValue)
    {
        return Gender::where($parameterName, $parameterValue)->firstOrFail()->id;
    }
}
