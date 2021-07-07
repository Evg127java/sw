<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * @package App\Models
 */
class Person extends Model
{

    protected $fillable = ['name', 'gender_id', 'hair_color', 'mass', 'height', 'homeworld_id', 'birth_year', 'url'];
    use HasFactory;

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function homeworld()
    {
        return $this->belongsTo(Homeworld::class);
    }

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }


}
