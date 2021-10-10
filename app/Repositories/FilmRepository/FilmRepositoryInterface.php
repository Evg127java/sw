<?php


namespace App\Repositories\FilmRepository;


use App\Entities\FilmEntity;

interface FilmRepositoryInterface
{
    /**
     * Gets all the instances from the repository
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
     * Add all the passed instances to the repository
     * @param array $entities
     */
    public function saveMany(array $entities);

    /**
     * Gets all the instances ids by the specified person id
     * @param int $id
     * @return mixed
     */
    public function getAllFilmsIdsByPersonId(int $id);

    /**
     * Removes all the instances by the specified person id
     * @param int $id
     * @return mixed
     */
    public function removeAllByPersonId(int $id);
}
