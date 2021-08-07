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
            'homeworld' => $this->homeworld['name'],
            'films' => (new ResourceUrlBuilder())($this->films, 'films/'),
            'url' => $this->url,
            'images' => (new ResourceUrlBuilder())($this->images, 'images/'),
        ];
    }
}
