<?php


namespace App\Repositories;


use App\Models\Gender;
use App\Repositories\Interfaces\GenderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GenderRepository
 * @package App\Repositories
 */
class GenderRepository implements GenderRepositoryInterface
{
    /**
     * Gets all the genders from the DB
     * @return Gender[]|Collection
     */
    public function getAll()
    {
        return Gender::all();
    }

    /**
     * Gets the id by the specified gender's type
     * @param string $genderValue gender's type to get an id
     * @return mixed
     */
    public function getIdByType(string $genderValue)
    {
        return Gender::where('type', $genderValue)->first()->id;
    }

    /**
     * Adds all the passed genders instances to the DB
     * @param array $gendersArray genders instances to add
     */
    public function addAll(array $gendersArray)
    {
        Gender::insertOrIgnore($gendersArray);
    }
}
