<?php


namespace App\Repositories\VehicleRepository;




use App\Entities\VehicleEntity;

interface VehicleRepositoryInterface
{
    /**
     * Gets the only instance by its name
     * @param string $name
     * @return VehicleEntity
     */
    public function getOneByName(string $name);

    /**
     * Add all passed instances to the sql repository
     * @param array $entities
     */
    public function saveMany(array $entities);

}
