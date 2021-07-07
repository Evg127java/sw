<?php


namespace App\Repositories\Interfaces;


interface PersonRepositoryInterface
{
    public function getAllByOrder(string $columnName, string $orderDirection);
    public function getAllByColumn(string $columnName, string $value);
    public function getOneById(int $id);
    public function getOneByName(string $value);
    public function addAll(array $peopleArray);
}
