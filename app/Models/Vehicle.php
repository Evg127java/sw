<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * Each vehicle is related (belongs to) to many people
     * @return BelongsToMany
     */
    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    /**
     * Each vehicle is related (belongs to) to many films
     * @return BelongsToMany
     */
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
