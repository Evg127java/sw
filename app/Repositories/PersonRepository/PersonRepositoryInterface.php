<?php


namespace App\Repositories\PersonRepository;


use App\Entities\PersonEntity;

interface PersonRepositoryInterface
{

    /**
     * Gets not sorted paginated instances
     * @param int $perPage
     * @return mixed
     */
    public function getAll(int $perPage);

    /**
     * Gets all instances by a specified sort type
     * @param string $sortedBy
     * @param string $sortDirection
     * @param array $relatedEntities array of related entities
     * @param bool $paginate paginate using flag
     * @return PersonEntity[]
     */
    public function getAllSorted(
        string $sortedBy, string $sortDirection,
        array $relatedEntities = [], $paginate = false
    );

    /**
     * Gets all instances by a specified parameter and its value
     * @param int $homeworld_id
     * @param array $relatedEntities array of related entities
     * @param bool $paginate paginate using flag
     * @return PersonEntity[]
     */
    public function getAllByHomeworld(int $homeworld_id, array $relatedEntities = [], $paginate = false);

    /**
     * Gets the only instance by a specified id
     * @param int $id
     * @return PersonEntity
     */
    public function getOneById(int $id);

    /**
     * Add all passed instances to a storage
     * @param array $entities
     */
    public function saveMany(array $entities);

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $name
     * @return PersonEntity
     */
    public function getOneByName(string $name);

    /**
     * Gets instances id by its name
     * @param string $name
     * @return int
     */
    public function getIdByName(string $name);

    /**
     * Removes the instance by its id
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);

    /**
     * Saves the passed data array as an instance
     * @param array $dataToStore
     * @return PersonEntity
     */
    public function saveOne(array $dataToStore);

    /**
     * Updates the passed entity with passed data
     * @param PersonEntity $person
     * @param array $dataToUpdate
     * @return mixed Updated instance
     */
    public function updateOne(PersonEntity $person, array $dataToUpdate);

    /**
     * Gets last saved instance's id's value
     * @return mixed
     */
    public function getLastId();
}
