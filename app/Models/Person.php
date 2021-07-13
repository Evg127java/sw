<?php

namespace App\Models;

use App\Http\Requests\PersonFormRequest;
use App\Services\PersonServices;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\File;
use Storage;

/**
 * Class Person
 *
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
     * Each person is related to many images(one to many)
     * @return HasMany
     */
    public function images()
    {
        return $this->HasMany(Image::class);
    }

    /**
     * Each person is related to many films(many to many)
     * @return BelongsToMany
     */
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

    /**
     * Makes a new person's model
     * @param array $request validated data from request
     * @return Person|Model
     */
    public static function createNewPerson(array $request)
    {
        return self::create($request);
    }

    /**
     * Updates person's with passed data
     * @param array $request validated data from request
     * @return Person
     */
    public function updatePerson(array $request)
    {
        /* Person update with validated data */
        $this->update($request);
        return $this;
    }

    /**
     * Deletes a person's instance by specified id
     * @param int $id person's id to delete
     */
    public static function deletePersonById(int $id)
    {
        /* Delete related person's directory from the storage before the person's deleting */
        Storage::deleteDirectory('images/' . $id);

        Person::destroy($id);
    }
}
