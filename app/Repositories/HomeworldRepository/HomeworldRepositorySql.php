<?php


namespace App\Repositories\HomeworldRepository;


use App\Entities\GenderEntity;
use App\Entities\HomeworldEntity;
use DB;
use Exception;

class HomeworldRepositorySql implements HomeworldRepositoryInterface
{
    private string $tableName = 'homeworlds';

    /**
     * Gets all instances from the sql repository
     * @return HomeworldEntity[]
     */
    public function getAll()
    {
        $homeworldsCollection = DB::table($this->tableName)->get();
        $homeworlds = $homeworldsCollection->map(function ($item) {
            return new HomeworldEntity(get_object_vars($item));
        });
        return $homeworlds->toArray();
    }

    /**
     * Gets an instance's id by its name from sql repository
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
     * Gets the only instance by its name
     * @param string $name
     * @return HomeworldEntity
     * @throws Exception
     */
    public function getOneByName(string $name)
    {
        $homeworld = DB::table($this->tableName)->where('name', $name)->first();
        if ($homeworld) {
            return new HomeworldEntity(get_object_vars($homeworld));
        }
        throw new Exception('No records for the passed name');
    }

    /**
     * Gets the only instance by its id value
     *
     * @param int $id
     * @return HomeworldEntity
     * @throws Exception
     */
    public function getOneById(int $id)
    {
        $homeworld = DB::table($this->tableName)->where('id', $id)->first();
        if ($homeworld) {
            return new HomeworldEntity(get_object_vars($homeworld));
        }
        throw new Exception('No records for the passed name');
    }

    /**
     * Add all passed instances to the sql repository
     * @param array $homeworlds
     */
    public function saveMany(array $homeworlds)
    {
        DB::table($this->tableName)->insertOrIgnore($homeworlds);
    }
}
