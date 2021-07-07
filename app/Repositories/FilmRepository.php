<?php


namespace App\Repositories;


use App\Models\Film;
use App\Repositories\Interfaces\FilmRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FilmRepository
 * @package App\Repositories
 */
class FilmRepository implements FilmRepositoryInterface
{
    /**
     * Gets all the films from the DB
     * @return Film[]|Collection
     */
    public function getAll()
    {
        return Film::all();
    }

    /**
     * Gets the only film instance by the specified id
     * @param int $id Film id to get
     * @return mixed
     */
    public function getOneById(int $id)
    {
        return Film::findOrFail($id);
    }

    /**
     * Adds all the passed films to the DB
     * @param array $filmsArray array of films to add
     */
    public function addAll(array $filmsArray)
    {
        Film::insertOrIgnore($filmsArray);
    }
}
