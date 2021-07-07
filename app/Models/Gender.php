<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Gender
 * @package App\Models
 * @mixin Eloquent
 */
class Gender extends Model
{
    use HasFactory;

    /**
     * Each gender related to many people
     * @return HasMany
     */
    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
