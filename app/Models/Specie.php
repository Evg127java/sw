<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specie extends Model
{
    use HasFactory;

    /**
     * Each specie is related (belongs to) to many people
     * @return HasMany
     */
    public function people()
    {
        return $this->HasMany(Person::class);
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
