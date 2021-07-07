<?php


namespace App\Repositories;


use App\Models\Person;
use App\Repositories\Interfaces\PersonRepositoryInterface;

/**
 * Class PersonRepository
 * @package App\Repositories
 */
class PersonRepository implements PersonRepositoryInterface
{
    /**
     * Gets All the people by specified order
     * @param string $columnName order parameter
     * @param string $orderDirection order direction
     * @return mixed
     */
    public function getAllByOrder(string $columnName, string $orderDirection)
    {
        return Person::orderBy($columnName, $orderDirection);
    }

    /**
     * Gets all the people by the specified column name and value
     * @param string $columnName Column name
     * @param string $value column value
     * @return mixed
     */
    public function getAllByColumn(string $columnName, string $value)
    {
        return Person::where($columnName, $value);
    }

    /**
     * Gets the only person by the specified id
     * @param int $id person's id to get
     * @return mixed
     */
    public function getOneById(int $id)
    {
        return Person::findOrFail($id);
    }

    /**
     * Gets the only person by the specified Name value
     * @param string $value Name's value
     * @return mixed
     */
    public function getOneByName(string $value)
    {
        return Person::firstWhere('name', $value);
    }

    /**
     * Gets all the people from the DB
     * @param array $peopleArray
     */
    public function addAll(array $peopleArray)
    {
        Person::insertOrIgnore($peopleArray);
    }
}
