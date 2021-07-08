<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Homeworld
 *
 * @package App\Models
 * @mixin Eloquent
 */
class Homeworld extends Model
{
    use HasFactory;

    /**
     * Each homeworld related to many people
     * @return HasMany
     */
    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
