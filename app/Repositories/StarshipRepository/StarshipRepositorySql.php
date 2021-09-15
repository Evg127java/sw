<?php


namespace App\Repositories\StarshipRepository;


use App\Models\Starship;

class StarshipRepositorySql implements StarshipRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $starshipsSet
     */
    public function addAll(array $starshipsSet)
    {
        Starship::insertOrIgnore($starshipsSet);
    }

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getStarshipByParameterAndValue(string $parameter, $value)
    {
        return Starship::firstWhere($parameter, $value);
    }
}
