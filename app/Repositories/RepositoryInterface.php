<?php


namespace App\Repositories;


/**
 * Interface RepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface RepositoryInterface
{
    /**
     * Gets all instances by specified order with specified relations
     * @param string $column
     * @param string $orderDirection
     * @param array $relations
     * @return mixed
     */
    public function getAllByOrderWithRelations(string $column, string $orderDirection, array $relations);

    /**
     * Gets all instances with their relations by the specified column name and value
     * @param string $column
     * @param string $value
     * @param array $relations
     * @return mixed
     */
    public function getAllByColumnValueWithRelations(string $column, string $value, array $relations);

    /**
     * Gets the only instance by the specified id
     * @param int $id
     * @return mixed
     */
    public function getOneById(int $id);

    /**
     * Gets the only instance by the specified column value
     * @param string $column
     * @param string $value
     * @return mixed
     */
    public function getOneByColumnValue(string $column, string $value);

    /**
     * Gets all instances from the DB
     * @return mixed
     */
    public function getAll();

    /**
     * Add all passed instances to the DB
     * @param array $modelsSet
     * @return mixed
     */
    public function addAll(array $modelsSet);

    /**
     * Gets the specified column value's id
     * @param string $column
     * @param string $value
     * @return mixed
     */
    public function getIdByColumnValue(string $column, string $value);
}
