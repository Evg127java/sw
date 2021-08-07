<?php

namespace App\Http\Resources;

use App\Models\Film;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Person;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'path' => $this->path,
            'person' => 'http://' . request()->server('HTTP_HOST') . '/api/people/' . $this->person_id,
        ];
    }
}
