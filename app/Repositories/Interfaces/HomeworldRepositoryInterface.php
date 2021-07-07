<?php


namespace App\Repositories\Interfaces;


/**
 * Interface HomeworldRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface HomeworldRepositoryInterface
{
    /**
     * Gets all the homeworlds from the DB
     * @return mixed
     */
    public function getAll();

    /**Adds all the passed homeworld instances to the DB
     * @param array $homeworldsArray
     * @return mixed
     */
    public function addAll(array $homeworldsArray);

    /**
     * Gets the only homeworld by the specified id
     * @param int $id
     * @return mixed
     */
    public function getOneById(int $id);
}
