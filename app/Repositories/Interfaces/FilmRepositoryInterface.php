<?php


namespace App\Repositories\Interfaces;


interface FilmRepositoryInterface
{
    public function getAll();
    public function getOneById(int $id);
    public function addAll(array $filmsArray);
}
