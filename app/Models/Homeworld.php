<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Homeworld
 * @package App\Models
 */
class Homeworld extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
