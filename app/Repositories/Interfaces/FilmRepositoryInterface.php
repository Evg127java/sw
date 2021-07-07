<?php


namespace App\Repositories\Interfaces;

/**
 * Interface FilmRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface FilmRepositoryInterface
{
    /**
     * Gets all the films from the DB
     * @return mixed
     */
    public function getAll();

    /**
     * Gets the only film instance by the specified id
     * @param int $id
     * @return mixed
     */
    public function getOneById(int $id);

    /**
     * Adds all the passed films to the DB
     * @param array $filmsArray
     * @return mixed
     */
    public function addAll(array $filmsArray);
}
