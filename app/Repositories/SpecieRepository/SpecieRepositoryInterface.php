<?php


namespace App\Repositories\SpecieRepository;



use App\Entities\SpecieEntity;

interface SpecieRepositoryInterface
{
    /**
     * Add all passed instances to the sql repository
     * @param array $entities
     */
    public function saveMany(array $entities);

    /**
     * Gets the only instance by its name
     * @param string $name
     * @return SpecieEntity
     */
    public function getOneByName(string $name);
}
