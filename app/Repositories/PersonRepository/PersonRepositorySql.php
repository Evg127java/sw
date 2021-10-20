<?php


namespace App\Repositories\PersonRepository;


use App\Entities\PersonEntity;
use DB;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PersonRepositorySql implements PersonRepositoryInterface
{
    private string $tableName = 'people';

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(int $perPage)
    {
        /* Get sorted Persons with related(one to many) entities in paginator */
        $temp = DB::table($this->tableName)
            ->join('genders','people.gender_id', '=', 'genders.id')
            ->join('homeworlds','people.homeworld_id', '=', 'homeworlds.id')
            ->select('people.*', 'genders.type as gender', 'homeworlds.name as homeworld')->paginate($perPage);

        /* Get new PersonEntity with all its relations for each one in the collection */
        $updated = $temp->getCollection()
            ->map(function($value) {
                $films = DB::table($this->tableName)
                    ->join('film_person','people.id', '=', 'film_person.person_id')
                    ->join('films','films.id', '=', 'film_person.film_id')
                    ->select('films.*')
                    ->where('person_id', $value->id)->get();
                $person = new PersonEntity(get_object_vars($value));
                $person->setFilms($films->toArray());
                $person->setGender($value->gender);
                $person->setHomeworld($value->homeworld);
                return $person;
            });
        $temp->setCollection($updated);
        return $temp;
    }

    /**
     * Gets all instances by specified sort with specified relations
     * @param string $sortedBy
     * @param string $sortDirection
     * @param string[] $relatedEntities
     * @param null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllSorted(
        string $sortedBy, string $sortDirection, array $relatedEntities = [], $perPage = null)
    {
        /* Get sorted Persons with related(one to many) entities in paginator */
        $temp = DB::table($this->tableName)
            ->join('genders','people.gender_id', '=', 'genders.id')
            ->join('homeworlds','people.homeworld_id', '=', 'homeworlds.id')
            ->select('people.*', 'genders.type as gender', 'homeworlds.name as homeworld')
            ->orderBy($sortedBy, $sortDirection)
            ->paginate($perPage);

        /* Get new PersonEntity with all its relations for each one in the collection */
        $updated = $temp->getCollection()
            ->map(function($value) {
                $films = DB::table($this->tableName)
                    ->join('film_person','people.id', '=', 'film_person.person_id')
                    ->join('films','films.id', '=', 'film_person.film_id')
                    ->select('films.*')
                    ->where('person_id', $value->id)->get();
                $person = new PersonEntity(get_object_vars($value));
                $person->setFilms($films->toArray());
                $person->setGender($value->gender);
                $person->setHomeworld($value->homeworld);
                return $person;
            });
        $temp->setCollection($updated);
        return $temp;
    }

    /**
     * Gets all instances by the specified parameter name, its value and relations
     * @param int $homeworld_id
     * @param string[] $relatedEntities
     * @param null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllByHomeworld(
        int $homeworld_id, array $relatedEntities = [], $perPage = null)
    {
        $temp = DB::table($this->tableName)
            ->leftJoin('homeworlds','people.homeworld_id', '=', 'homeworlds.id')
            ->select('people.*', 'homeworlds.name as homeworld')
            ->where('homeworld_id', $homeworld_id)
            ->paginate($perPage);
        $updated = $temp->getCollection()
            ->map(function($value) {
                $films = DB::table($this->tableName)
                    ->join('film_person','people.id', '=', 'film_person.person_id')
                    ->join('films','films.id', '=', 'film_person.film_id')
                    ->select('films.*')
                    ->where('person_id', $value->id)->get();
                $images = DB::table('images')
                    ->where('person_id', $value->id)->get();
                $person = new PersonEntity(get_object_vars($value));
                $person->setFilms($films->toArray());
                $person->setImages($images->toArray());
                return $person;
            });
        $temp->setCollection($updated);
        return $temp;
    }

    /**
     * Gets the only instance by the specified id
     * @param int $id instance's id value to get
     * @return PersonEntity
     * @throws Exception
     */
    public function getOneById(int $id)
    {
        /* Get a person with related(one to many) entities */
        $temp = DB::table($this->tableName)
            ->join('genders','people.gender_id', '=', 'genders.id')
            ->join('homeworlds','people.homeworld_id', '=', 'homeworlds.id')
            ->select('people.*', 'genders.type as gender', 'homeworlds.name as homeworld')
            ->where('people.id', $id)->first();
        if ($temp) {
            /* Get related(many to many) entities set for the person */
            $films = DB::table($this->tableName)
                ->join('film_person','people.id', '=', 'film_person.person_id')
                ->join('films','films.id', '=', 'film_person.film_id')
                ->select('films.*')
                ->where('person_id', $id)->get();

            /* Build the new PersonEntity with related data */
            $person = new PersonEntity(get_object_vars($temp));
            $person->setFilms($films->toArray());
            $person->setGender($temp->gender);
            $person->setHomeworld($temp->homeworld);
            return $person;
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
     * Gets instances id by its name
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
     * Saves the passed data array as an instance to the repository
     * @param array $dataToStore
     * @return PersonEntity Saved instance if the operation is successful
     * @throws Exception    If saving operation is not successful
     */
    public function saveOne(array $dataToStore)
    {
        /* Set Entity's create data */
        $createDate = date('Y-m-d H:i:s', strtotime('now'));
        $dataToStore['created_at'] = $createDate;
        DB::table($this->tableName)->insert($dataToStore);
        return $this->getOneById(DB::getPdo()->lastInsertId());
    }

    /**
     * Updates the passed entity with passed data
     * @param PersonEntity $person
     * @param array $dataToUpdate
     * @return PersonEntity|mixed
     */
    public function updateOne(PersonEntity $person, array $dataToUpdate)
    {
        /* Set the data to update depending on the person has films or not */
        $filmsIds = $dataToUpdate['films'] ?? null;
        unset($dataToUpdate['films']);

        /* Set Entity's update data */
        $updateTime = date('Y-m-d H:i:s', strtotime('now'));
        $dataToUpdate['updated_at'] = $updateTime;

        /* Save related(many to many) data */
        if ($filmsIds) {
            $personFilms = [];
            foreach ($filmsIds as $filmId) {
                $personFilms[] = [
                    'person_id' => $person->getId(),
                    'film_id' => $filmId,
                    'created_at' => $updateTime,
                    'updated_at' => $updateTime,
                ];
            }
            DB::table('film_person')->insertOrIgnore($personFilms);
        }

        /* Save person data in DB */
        DB::table($this->tableName)
            ->where('id', $person->getId())
            ->update($dataToUpdate);
        return $person;
    }

    /**
     * Removes the instance by its id
     * @param int $id
     * @return mixed|void
     */
    public function deleteById(int $id)
    {
        DB::table($this->tableName)
            ->where('id', $id)
            ->delete();
    }

    /**
     * Gets last saved instance's id's value
     * @return mixed
     */
    public function getLastId()
    {
        return DB::table($this->tableName)->latest('id')->first()->id;
    }

}
