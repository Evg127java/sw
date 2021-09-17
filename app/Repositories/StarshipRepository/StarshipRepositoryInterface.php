<?php


namespace App\Repositories\StarshipRepository;



interface StarshipRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $entities
     */
    public function saveMany(array $entities);

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getOneByParameter(string $parameter, $value);
}
