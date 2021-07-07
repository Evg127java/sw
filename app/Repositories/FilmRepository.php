<?php


namespace App\Repositories;


use App\Models\Film;
use App\Repositories\Interfaces\FilmRepositoryInterface;

class FilmRepository implements FilmRepositoryInterface
{
    public function getAll()
    {
        return Film::all();
    }

    public function getOneById(int $id)
    {
        return Film::findOrFail($id);
    }

    public function addAll(array $filmsArray)
    {
        Film::insertOrIgnore($filmsArray);
    }
}
