<?php


namespace App\Repositories\FilmRepository;


use App\Entities\FilmEntity;
use DB;
use Exception;

class FilmRepositorySql implements FilmRepositoryInterface
{
    /**
     * Gets all instances from the repository
     * @return FilmEntity[]
     */
    public function getAll()
    {
        $filmsCollection = DB::table('films')->get();
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
        $filmFromSql = DB::table('films')->where('id', $id)->first();
        if ($filmFromSql) {
            return new FilmEntity(get_object_vars($filmFromSql));
        }
        throw new Exception('No records for the passed id');
    }

    /**
     * Add all passed instances to the repository
     * @param array $films
     */
    public function saveMany(array $films)
    {
        DB::table('films')->insertOrIgnore($films);
    }
}
