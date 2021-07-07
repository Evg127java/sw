<?php


namespace App\Repositories\Interfaces;


/**
 * Interface GenderRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface GenderRepositoryInterface
{
    /**
     * Gets all the genders from the DB
     * @return mixed
     */
    public function getAll();

    /**
     * Gets the id by the specified gender's type
     * @param string $genderValue
     * @return mixed
     */
    public function getIdByType(string $genderValue);

    /**
     * Adds all the passed genders instances to the DB
     * @param array $gendersArray
     * @return mixed
     */
    public function addAll(array $gendersArray);
}
