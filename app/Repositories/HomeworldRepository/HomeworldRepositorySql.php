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
            return new GenderEntity(get_object_vars($item));
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
        $id = DB::table($this->tableName)->where($name)->first()->id;
        if ($id) {
            return $id;
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
