<?php


namespace App\Repositories\Interfaces;


/**
 * Interface PersonRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface PersonRepositoryInterface
{
    /**
     * Gets All the people by specified order
     * @param string $columnName
     * @param string $orderDirection
     * @return mixed
     */
    public function getAllByOrder(string $columnName, string $orderDirection);

    /**
     * Gets all the people by the specified column name and value
     * @param string $columnName
     * @param string $value
     * @return mixed
     */
    public function getAllByColumn(string $columnName, string $value);

    /**
     * Gets the only person by the specified id
     * @param int $id
     * @return mixed
     */
    public function getOneById(int $id);

    /**
     * Gets the only person by the specified Name value
     * @param string $value
     * @return mixed
     */
    public function getOneByName(string $value);

    /**
     * Gets all the people from the DB
     * @param array $peopleArray
     * @return mixed
     */
    public function addAll(array $peopleArray);
}
