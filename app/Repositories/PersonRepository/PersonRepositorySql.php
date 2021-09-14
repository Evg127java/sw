<?php


namespace App\Repositories\PersonRepository;


use App\Models\Person;

class PersonRepositorySql implements PersonRepositoryInterface
{
    /**
     * Gets all instances by specified sort with specified relations
     * @param string $sortedBy
     * @param string $sortDirection
     * @param array $relationEntities
     * @param bool $paginate
     * @return mixed
     */
    public function getAllPeopleSorted(
        string $sortedBy, string $sortDirection, array $relationEntities = [], $paginate = false)
    {
        $temp = Person::with($relationEntities)->orderBy($sortedBy, $sortDirection);
        return $paginate ? $temp->paginate(config('app.peoplePerPageAtAll')) : $temp->get();
    }

    /**
     * Gets the only instance by the specified id
     * @param int $id instance's id value to get
     * @return mixed
     */
    public function getPersonById(int $id)
    {
        return Person::findOrFail($id);
    }

    /**
     * Add all passed instances to the BD
     * @param array $peopleSet
     */
    public function addAllPeople(array $peopleSet)
    {
        Person::insertOrIgnore($peopleSet);
    }

    /**
     * Add created instance with specified data to DB
     * @param array $data
     * @return mixed|void
     */
    public function addPersonFromData(array $data)
    {
        Person::create($data);
    }

    /**
     * Gets all instances by the specified parameter name, its value and relations
     * @param string $parameter
     * @param string $value column value
     * @param array $relatedEntities
     * @param bool $paginate
     * @return mixed
     */
    public function getAllPeopleByParameter(
        string $parameter, $value, array $relatedEntities = [], $paginate = false)
    {
        $temp = Person::with($relatedEntities)->where($parameter, $value);
        return $paginate ? $temp->paginate(config('app.peoplePerPageOnPlanet')) : $temp->get();
    }

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getPersonByParameterAndValue(string $parameter, $value)
    {
        return Person::firstWhere($parameter, $value);
    }
}
