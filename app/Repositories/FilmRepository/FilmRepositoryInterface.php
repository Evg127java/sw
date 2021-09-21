<?php


namespace App\Repositories\FilmRepository;


use App\Entities\FilmEntity;

interface FilmRepositoryInterface
{
    /**
     * Gets all instances from the repository
     * @return FilmEntity[]
     */
    public function getAll();

    /**
     * Gets the only instance by the specified id from the repository
     * @param int $id
     * @return FilmEntity
     */
    public function getOneById(int $id);


    /**
     * Add all passed instances to the repository
     * @param array $entities
     */
    public function saveMany(array $entities);
}
