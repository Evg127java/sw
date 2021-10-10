<?php


namespace App\Repositories\FilmRepository;


use App\Entities\FilmEntity;
use DB;
use Exception;

class FilmRepositorySql implements FilmRepositoryInterface
{

    private string $tableName = 'films';

    /**
     * Gets all the instances from the repository
     * @return FilmEntity[]
     */
    public function getAll()
    {
        $filmsCollection = DB::table($this->tableName)->get();
        $films = $filmsCollection->map(function ($item) {
            return new FilmEntity(get_object_vars($item));
        });
        return $films->toArray();
    }

    /**
     * Gets the only instance by the specified id from the repository
     * @param int $id
     * @return FilmEntity
     * @throws Exception
     */
    public function getOneById(int $id)
    {
        $filmFromSql = DB::table($this->tableName)->where('id', $id)->first();
        if ($filmFromSql) {
            return new FilmEntity(get_object_vars($filmFromSql));
        }
        throw new Exception('No records for the passed id');
    }

    /**
     * Add all the passed instances to the repository
     * @param array $films
     */
    public function saveMany(array $films)
    {
        DB::table($this->tableName)->insertOrIgnore($films);
    }

    /**
     * Gets all the instances ids by the specified person id
     * @param int $id
     * @return array|mixed
     */
    public function getAllFilmsIdsByPersonId(int $id)
    {
        $result = DB::table('film_person')->where('person_id', $id)->get();
        return $result->pluck('film_id')->toArray();
    }

    /**
     * Removes all the instances by the specified person id
     * @param int $id
     */
    public function removeAllByPersonId(int $id)
    {
        DB::table('film_person')->where('person_id', $id)->delete();
    }
}
