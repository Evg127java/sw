<?php


namespace App\Repositories\HomeworldRepository;


use App\Entities\HomeworldEntity;

interface HomeworldRepositoryInterface
{
    /**
     * Gets all instances from the repository
     * @return HomeworldEntity[]
     */
    public function getAll();

    /**
     * Gets instance's id by its name
     * @param string $name
     * @return int
     */
    public function getIdByName(string $name);


    /**
     * Add all passed instances to the repository
     * @param array $entities
     */
    public function saveMany(array $entities);
}
