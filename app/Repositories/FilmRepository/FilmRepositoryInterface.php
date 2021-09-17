<?php


namespace App\Repositories\FilmRepository;


use App\Models\Film;
use App\Repositories\BaseRepositoryInterface;

interface FilmRepositoryInterface
{
    /**
     * Gets all instances
     * @return Film[]
     */
    public function getAll();

    /**
     * Gets the only instance by the specified id
     * @param int $id
     * @return Film
     */
    public function getOneById(int $id);


    /**
     * Add all passed instances to a storage
     * @param array $entities
     */
    public function saveMany(array $entities);
}
