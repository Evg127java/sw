<?php


namespace App\Repositories\GenderRepository;


use App\Models\Gender;

interface GenderRepositoryInterface
{
    /**
     * Gets all instances from a storage
     * @return array
     */
    public function getAll();

    /**
     * Add all passed instances to a storage
     * @param array $entitiesSet
     */
    public function addAll(array $entitiesSet);

    /**
     * Gets instance's id by the specified parameter and its value
     * @param string $parameterName
     * @param string $parameterValue
     * @return int
     */
    public function getIdByParameter(string $parameterName, string $parameterValue);
}
