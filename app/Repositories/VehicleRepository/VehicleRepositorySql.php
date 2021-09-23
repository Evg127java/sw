<?php


namespace App\Repositories\VehicleRepository;


use App\Entities\VehicleEntity;
use DB;
use Exception;

class VehicleRepositorySql implements VehicleRepositoryInterface
{
    private string $tableName = 'vehicles';

    /**
     * Gets the only instance by its name
     * @param string $name
     * @return VehicleEntity
     * @throws Exception
     */
    public function getOneByName(string $name)
    {
        $starship = DB::table($this->tableName)->where('name',$name)->first();
        if ($starship) {
            return new VehicleEntity(get_object_vars($starship));
        }
        throw new Exception('No records for the passed name');
    }

    /**
     * Add all passed instances to the sql repository
     * @param array $vehicles
     */
    public function saveMany(array $vehicles)
    {
        DB::table($this->tableName)->insertOrIgnore($vehicles);
    }
}
