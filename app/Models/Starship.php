<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Starship
 * @package App\Models
 */
class Starship extends Model
{
    use HasFactory;

    /**
     * Each starship is related (belongs to) to many people
     * @return BelongsToMany
     */
    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    /**
     * Each starship is related (belongs to) to many films
     * @return BelongsToMany
     */
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
