<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gender
 * @package App\Models
 */
class Gender extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
