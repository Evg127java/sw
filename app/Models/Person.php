<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Person
 * @package App\Models
 * @mixin Eloquent
 */
class Person extends Model
{
    /* Mass assignment */
    protected $fillable = ['name', 'gender_id', 'hair_color', 'mass', 'height', 'homeworld_id', 'birth_year', 'url'];

    use HasFactory;

    /**
     * Each person is related (belongs to) to only one gender
     * @return BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Each person is related (belongs to) to only one homeworld
     * @return BelongsTo
     */
    public function homeworld()
    {
        return $this->belongsTo(Homeworld::class);
    }

    /**
     * Each person is related to many films(many to many)
     * @return BelongsToMany
     */
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
