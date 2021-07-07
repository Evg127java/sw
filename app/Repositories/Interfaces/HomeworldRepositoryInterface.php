<?php


namespace App\Repositories\Interfaces;


interface HomeworldRepositoryInterface
{
    public function getAll();
    public function addAll(array $homeworldsArray);
    public function getOneById(int $id);
}
