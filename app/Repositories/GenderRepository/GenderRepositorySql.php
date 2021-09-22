<?php


namespace App\Repositories\GenderRepository;


use App\Entities\GenderEntity;
use DB;
use Exception;

class GenderRepositorySql implements GenderRepositoryInterface
{
    private string $tableName = 'genders';

    /**
     * Gets all instances from the repository
     * @return GenderEntity[]
     */
    public function getAll()
    {
        $gendersCollection = DB::table($this->tableName)->get();
        $genders = $gendersCollection->map(function ($item) {
            return new GenderEntity(get_object_vars($item));
        });
        return $genders->toArray();
    }

    /**
     * Gets instance's id by its type
     * @param string $type
     * @return int
     * @throws Exception
     */
    public function getIdByType(string $type)
    {
        $id = DB::table($this->tableName)->where('type', $type)->first()->id;
        if ($id) {
            return $id;
        }
        throw new Exception('No records for the passed type');
    }

    /**
     * Add all passed instances to the repository
     * @param array $genders
     */
    public function saveMany(array $genders)
    {
        DB::table($this->tableName)->insertOrIgnore($genders);
    }
}
