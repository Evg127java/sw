<?php


namespace App\Repositories;


use App\Models\Film;
use App\Models\Homeworld;
use App\Repositories\Interfaces\HomeworldRepositoryInterface;

class HomeworldRepository implements HomeworldRepositoryInterface
{
    public function getAll()
    {
        return Homeworld::all();
    }

    public function addAll(array $homeworldsArray)
    {
        Homeworld::insertOrIgnore($homeworldsArray);
    }

    public function getOneById(int $id)
    {
        return Homeworld::findOrFail($id);
    }
}
