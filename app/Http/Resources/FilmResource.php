<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'people' => (new CollectionLinksBuilder())($this->people, 'people/'),
            'url' => (new SingleLinkBuilder())($this->id, 'films/'),
        ];
    }
}
