<?php


namespace App\Repositories\HomeworldRepository;


use App\Repositories\BaseRepositoryInterface;

interface HomeworldRepositoryInterface
{
    /**
     * Gets all instances from a storage
     * @return array
     */
    public function getAll();

    /**
     * Gets instance's id by the specified parameter and its value
     * @param string $parameterName
     * @param string $parameterValue
     * @return int
     */
    public function getIdByParameter(string $parameterName, string $parameterValue);


    /**
     * Add all passed instances to a storage
     * @param array $entities
     */
    public function saveMany(array $entities);
}
