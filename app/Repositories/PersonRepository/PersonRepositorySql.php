<?php


namespace App\Repositories\PersonRepository;


use App\Entities\PersonEntity;
use App\Models\Person;
use DB;
use Exception;

class PersonRepositorySql implements PersonRepositoryInterface
{
    private string $tableName = 'people';

    /**
     * Gets all instances by specified sort with specified relations
     * @param string $sortedBy
     * @param string $sortDirection
     * @param array $relatedEntities
     * @param bool $paginate
     * @return PersonEntity[]
     */
    public function getAllSorted(
        string $sortedBy, string $sortDirection, array $relatedEntities = [], $paginate = false)
    {
        $temp = Person::with($relatedEntities)->orderBy($sortedBy, $sortDirection);
        return $paginate ? $temp->paginate(config('app.peoplePerPageAtAll')) : $temp->get();
    }

    /**
     * Gets all instances by the specified parameter name, its value and relations
     * @param string $homeworld
     * @param array $relatedEntities
     * @param bool $paginate
     * @return PersonEntity[]
     */
    public function getAllByHomeworld(
        string $homeworld, array $relatedEntities = [], $paginate = false)
    {
        $temp = Person::with($relatedEntities)->where($homeworld);
        return $paginate ? $temp->paginate(config('app.peoplePerPageOnPlanet')) : $temp->get();
    }

    /**
     * Gets the only instance by the specified id
     * @param int $id instance's id value to get
     * @return PersonEntity
     * @throws Exception
     */
    public function getOneById(int $id)
    {
        $filmFromSql = DB::table($this->tableName)->where('id', $id)->first();
        if ($filmFromSql) {
            return new PersonEntity(get_object_vars($filmFromSql));
        }
        throw new Exception('No records for the passed id');
    }

    /**
     * Gets the only instance by its name
     * @param string $name
     * @return PersonEntity
     * @throws Exception
     */
    public function getOneByName(string $name)
    {
        $person = DB::table($this->tableName)->where('name', $name)->first();
        if ($person) {
            return new PersonEntity(get_object_vars($person));
        }
        throw new Exception('No records for the passed name');
    }

    /**
     * Add all passed instances to the sql repository
     * @param array $entities
     */
    public function saveMany(array $entities)
    {
        DB::table($this->tableName)->insertOrIgnore($entities);
    }

    /**
     * @param string $name
     * @return int
     * @throws Exception
     */
    public function getIdByName(string $name)
    {
        $id = DB::table($this->tableName)->where('name', $name)->first()->id;
        if ($id) {
            return $id;
        }
        throw new Exception('No records for the passed name');
    }

    /**
     * @param array $dataToUpdate
     * @return mixed|void
     */
    public function updateMany(array $dataToUpdate)
    {
        DB::table($this->tableName)->update($dataToUpdate);
    }
}
