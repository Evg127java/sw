<?php


namespace App\Http\Resources;


use Illuminate\Database\Eloquent\Collection;

class CollectionLinksBuilder
{
    /**
     * Builds resources' url for the specified collections
     *
     * @param Collection $resources
     * @param string $collection
     * @return \Illuminate\Support\Collection
     */
    public function __invoke(Collection $resources, string $collection)
    {
        /* Url prefix that contains the hostName, api identifier and collection's name  */
        $hostApi = 'http://' . request()->server('HTTP_HOST') . '/api/';

        return collect($resources)
            ->pluck('id')
            ->map(function ($id) use ($hostApi, $collection) {
                return $hostApi . $collection . $id;
            });
    }
}
