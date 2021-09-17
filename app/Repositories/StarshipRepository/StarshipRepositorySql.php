<?php


namespace App\Repositories\StarshipRepository;


use App\Models\Starship;

class StarshipRepositorySql implements StarshipRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $starships
     */
    public function saveMany(array $starships)
    {
        Starship::insertOrIgnore($starships);
    }

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getOneByParameter(string $parameter, $value)
    {
        return Starship::firstWhere($parameter, $value);
    }
}
