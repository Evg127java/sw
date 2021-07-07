<?php


namespace App\Repositories;


use App\Models\Gender;
use App\Repositories\Interfaces\GenderRepositoryInterface;

class GenderRepository implements GenderRepositoryInterface
{
    public function getAll()
    {
        return Gender::all();
    }

    public function getIdByType(string $genderValue)
    {
        return Gender::where('type', $genderValue)->first()->id;
    }

    public function addAll(array $gendersArray)
    {
        Gender::insertOrIgnore($gendersArray);
    }
}
