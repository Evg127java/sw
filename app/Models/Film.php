<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Film
 * @package App\Models
 */
class Film extends Model
{
    use HasFactory;
    public function people()
    {
        return $this->belongsToMany(Person::class);
    }
}
