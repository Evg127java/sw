<?php


namespace App\Repositories;


use App\Models\Film;
use App\Models\Homeworld;
use App\Repositories\Interfaces\HomeworldRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


/**
 * Class HomeworldRepository
 * @package App\Repositories
 */
class HomeworldRepository implements HomeworldRepositoryInterface
{
    /**
     * Gets all the homeworlds from the DB
     * @return Homeworld[]|Collection
     */
    public function getAll()
    {
        return Homeworld::all();
    }

    /**
     * Adds all the passed homeworld instances to the DB
     * @param array $homeworldsArray homeworld instances to add
     */
    public function addAll(array $homeworldsArray)
    {
        Homeworld::insertOrIgnore($homeworldsArray);
    }

    /**
     * Gets the only homeworld by the specified id
     * @param int $id  id to get a homeworld
     * @return mixed
     */
    public function getOneById(int $id)
    {
        return Homeworld::findOrFail($id);
    }
}
