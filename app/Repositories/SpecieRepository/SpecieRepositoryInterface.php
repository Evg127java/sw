<?php


namespace App\Repositories\SpecieRepository;


interface SpecieRepositoryInterface
{
    /**
     * Add all passed instances to a storage
     * @param array $entitiesSet
     */
    public function addAll(array $entitiesSet);

    /**
     * Gets the only instance by the specified parameter and its value
     * @param string $parameter
     * @param $value
     * @return mixed
     */
    public function getSpecieByParameterAndValue(string $parameter, $value);
}
