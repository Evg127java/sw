<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeworldResource extends JsonResource
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
            'name' => $this->name,
            'people' => (new CollectionLinksBuilder())($this->people, 'people/'),
            'url' => (new SingleLinkBuilder())($this->id, 'homeworlds/'),
        ];
    }
}
