<?php


namespace App\Repositories\PersonRepository;


interface PersonRepositoryInterface
{
    /**
     * Gets all instances by specified sort type
     * @param string $sortedBy
     * @param string $sortDirection
     * @param array $relationEntities array of related entities
     * @param bool $paginate paginate using flag
     * @return mixed
     */
    public function getAllPeopleSorted(string $sortedBy, string $sortDirection, array $relationEntities = [], $paginate = false);

    /**
     * Gets all instances by the specified parameter and its value
     * @param string $parameter
     * @param string $value parameter's value
     * @param array $relatedEntities array of related entities
     * @param bool $paginate paginate using flag
     * @return mixed
     */
    public function getAllPeopleByParameter(string $parameter, $value, array $relatedEntities = [], $paginate = false);

    /**
     * Gets the only instance by the specified id
     * @param int $id
     * @return mixed
     */
    public function getPersonById(int $id);

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getPersonByParameterAndValue(string $parameter, $value);

    /**
     * Add all passed instances to the DB
     * @param array $peopleSet
     * @return mixed
     */
    public function addAllPeople(array $peopleSet);

    /**
     * Add all passed instances to the DB
     * @param array $data
     * @return mixed
     */
    public function addPersonFromData(array $data);
}
