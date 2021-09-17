<?php


namespace App\Repositories\FilmRepository;


use App\Models\Film;
use Illuminate\Database\Eloquent\Collection;

class FilmRepositorySql implements FilmRepositoryInterface
{
    /**
     * Gets all Films from a source
     * @return Film[]|Collection|mixed
     */
    public function getAll()
    {
        return Film::all();
    }

    /**
     * Gets the only Film by the specified id
     * @param int $id
     * @return Film
     */
    public function getOneById(int $id)
    {
        return Film::findOrFail($id);
    }

    /**
     * Add all passed instances to the DB
     * @param array $films
     */
    public function saveMany(array $films)
    {
        Film::insertOrIgnore($films);
    }
}
