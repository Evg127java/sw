<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'height' => $this->height,
            'mass' => $this->mass,
            'hair_color' => $this->hair_color,
            'birth_year' => $this->birth_year,
            'gender' => $this->gender['type'],
            'homeworld' => (new SingleLinkBuilder())($this->homeworld['id'], 'homeworlds/'),
            'films' => (new CollectionLinksBuilder())($this->films, 'films/'),
            'SWAPIUrl' => $this->url,
            'images' => (new CollectionLinksBuilder())($this->images, 'images/'),
            'url' => (new SingleLinkBuilder())($this->id, 'people/'),
        ];
    }
}
