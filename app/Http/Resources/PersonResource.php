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
            'name' => $this->getName(),
            'height' => $this->getHeight(),
            'mass' => $this->getMass(),
            'hair_color' => $this->getHairColor(),
            'birth_year' => $this->getBirthYear(),
            'gender' => $this->getGenderId(),
            'homeworld' => (new SingleLinkBuilder())($this->getHomeworldId(), 'homeworlds/'),
            'films' => (new CollectionLinksBuilder())(collect($this->getFilms()), 'films/'),
            'SWAPIUrl' => $this->getUrl(),
            'images' => (new CollectionLinksBuilder())($this->getImages(), 'images/'),
            'url' => (new SingleLinkBuilder())($this->getId(), 'people/'),
        ];
    }
}
