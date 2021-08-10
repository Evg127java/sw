<?php


namespace App\Http\Resources;



class SingleLinkBuilder
{
    /**
     * Builds resources' url for the specified collections
     *
     * @param int $id
     * @param string $collection
     * @return string
     */
    public function __invoke(int $id, string $collection)
    {
        /* Url prefix that contains the hostName, api identifier and collection's name  */
        $hostApi = 'http://' . request()->server('HTTP_HOST') . '/api/';

        return $hostApi . $collection . $id;
    }
}
