<?php


namespace App\Repositories\Interfaces;


interface GenderRepositoryInterface
{
    public function getAll();
    public function getIdByType(string $genderValue);
    public function addAll(array $gendersArray);
}
