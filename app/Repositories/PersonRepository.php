<?php


namespace App\Repositories;


use App\Models\Person;
use App\Repositories\Interfaces\PersonRepositoryInterface;

class PersonRepository implements PersonRepositoryInterface
{

    public function getAllByOrder(string $columnName, string $orderDirection)
    {
        return Person::orderBy($columnName, $orderDirection);
    }

    public function getAllByColumn(string $columnName, string $value)
    {
        return Person::where($columnName, $value);
    }

    public function getOneById(int $id)
    {
        return Person::findOrFail($id);
    }

    public function getOneByName(string $value)
    {
        return Person::firstWhere('name', $value);
    }

    public function addAll(array $peopleArray)
    {
        Person::insertOrIgnore($peopleArray);
    }
}
