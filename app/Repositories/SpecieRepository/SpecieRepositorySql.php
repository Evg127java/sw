<?php


namespace App\Repositories\SpecieRepository;


use App\Entities\SpecieEntity;
use DB;
use Exception;

class SpecieRepositorySql implements SpecieRepositoryInterface
{
    private string $tableName = 'species';

    /**
     * Add all passed instances to the sql repository
     * @param array $species
     */
    public function saveMany(array $species)
    {
        DB::table($this->tableName)->insertOrIgnore($species);
    }

    /**
     * Gets the only instance by its name
     * @param string $name
     * @return SpecieEntity
     * @throws Exception
     */
    public function getOneByName(string $name)
    {
        $specie = DB::table($this->tableName)->where('name',$name)->first();
        if ($specie) {
            return new SpecieEntity(get_object_vars($specie));
        }
        throw new Exception('No records for the passed name');
    }
}
