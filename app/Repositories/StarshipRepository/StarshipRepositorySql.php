<?php


namespace App\Repositories\StarshipRepository;


use App\Entities\StarshipEntity;
use DB;
use Exception;

class StarshipRepositorySql implements StarshipRepositoryInterface
{
    private string $tableName = 'starships';

    /**
     * Gets the only instance by its name
     * @param string $name
     * @return StarshipEntity
     * @throws Exception
     */
    public function getOneByName(string $name)
    {
        $starship = DB::table($this->tableName)->where('name',$name)->first();
        if ($starship) {
            return new StarshipEntity(get_object_vars($starship));
        }
        throw new Exception('No records for the passed name');
    }

    /**
     * Add all passed instances to the sql repository
     * @param array $starships
     */
    public function saveMany(array $starships)
    {
        DB::table($this->tableName)->insertOrIgnore($starships);
    }
}
