<?php


namespace App\Repositories\StarshipRepository;



use App\Entities\StarshipEntity;

interface StarshipRepositoryInterface
{
    /**
     * Gets the only instance by its name
     * @param string $name
     * @return StarshipEntity
     */
    public function getOneByName(string $name);

    /**
     * Add all passed instances to the sql repository
     * @param array $entities
     */
    public function saveMany(array $entities);

}
