<?php


namespace App\Repositories\GenderRepository;


use App\Entities\GenderEntity;

interface GenderRepositoryInterface
{
    /**
     * Gets all instances from the repository
     * @return GenderEntity[]
     */
    public function getAll();

    /**
     * Gets instance's id by its type
     * @param string $type
     * @return int
     */
    public function getIdByType(string $type);

    /**
     * Add all passed instances to the repository
     * @param array $entities
     */
    public function saveMany(array $entities);
}
