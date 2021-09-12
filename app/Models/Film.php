<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Film
 *
 * @package App\Models
 * @mixin Eloquent
 */
class Film extends Model
{
    use HasFactory;

    /**
     * Each film is related to many people (many to many)
     * @return BelongsToMany
     */
    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    /**
     * Each film is related to many starships (many to many)
     * @return BelongsToMany
     */
    public function starships()
    {
        return $this->belongsToMany(Starship::class);
    }

    /**
     * Each film is related to many vehicles (many to many)
     * @return BelongsToMany
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
