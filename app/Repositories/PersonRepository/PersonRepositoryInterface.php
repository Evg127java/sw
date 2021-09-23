<?php


namespace App\Repositories\PersonRepository;



use App\Entities\PersonEntity;

interface PersonRepositoryInterface
{
    /**
     * Gets all instances by a specified sort type
     * @param string $sortedBy
     * @param string $sortDirection
     * @param array $relatedEntities array of related entities
     * @param bool $paginate paginate using flag
     * @return PersonEntity[]
     */
    public function getAllSorted(string $sortedBy, string $sortDirection, array $relatedEntities = [], $paginate = false);

    /**
     * Gets all instances by a specified parameter and its value
     * @param string $homeworld
     * @param array $relatedEntities array of related entities
     * @param bool $paginate paginate using flag
     * @return PersonEntity[]
     */
    public function getAllByHomeworld(string $homeworld, array $relatedEntities = [], $paginate = false);

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
     * @param string $name
     * @return int
     */
    public function getIdByName(string $name);

    /**
     * @param array $dataToUpdate
     * @return mixed
     */
    public function update(array $dataToUpdate);
}
