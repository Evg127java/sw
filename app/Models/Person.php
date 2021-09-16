<?php

namespace App\Models;

use Arr;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    protected $fillable =
        [
            'name', 'gender_id', 'hair_color', 'mass',
            'height', 'homeworld_id', 'birth_year', 'url'
        ];

    use HasFactory;


    /*
    |--------------------------------------------------------------------------
    | Relations to other entities
    |--------------------------------------------------------------------------
    */

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
     * Each person is related to many starships(many to many)
     * @return BelongsToMany
     */
    public function starships()
    {
        return $this->belongsToMany(Starship::class);
    }

    /**
     * Each person is related to many vehicles(many to many)
     * @return BelongsToMany
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }

    /**
     * Each person is related(belongs to) to the only specie(one to many)
     * @return BelongsTo
     */
    public function specie()
    {
        return $this->belongsTo(Specie::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Models operations
    |--------------------------------------------------------------------------
    */

    /**
     * Makes a new person's model
     * @param array $request validated data from request
     * @return Person|Model
     */
    public static function createNewPerson(array $request)
    {
        $person = self::create($request);
        self::processRelations($request, $person);
        return $person;
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
        self::processRelations($request, $this);
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

    /*
    |--------------------------------------------------------------------------
    | Person's related entities' processing
    |--------------------------------------------------------------------------
    */

    /**
     * Runs a person's relation processes
     * @param array $request
     * @param Person $currentPerson
     */
    public static function processRelations(array $request, Person $currentPerson)
    {
        self::processFilms($request, $currentPerson);
        self::processImages($request,$currentPerson);
    }

    /*
    |--------------------------------------------------------------------------
    | FILMS for person processing
    |--------------------------------------------------------------------------
    */

    /**
     * Updates films specified in form request for the person
     * @param array $request
     * @param Person $currentPerson
     */
    public static function processFilms(array $request, Person $currentPerson)
    {
        Arr::exists($request, 'films') ?
            $currentPerson->addFilms($request['films'], $currentPerson) :
            $currentPerson->removeAllFilms($currentPerson);
    }

    /**
     * Adds passed films to the current person
     * @param array $films
     * @param Person $currentPerson
     */
    public static function addFilms(array $films, Person $currentPerson)
    {
        $currentPerson->films()->sync($films);
    }

    /**
     * Deletes all the films related to the current person
     * @param Person $currentPerson
     */
    public static function removeAllFilms(Person $currentPerson)
    {
        $currentPerson->films()->detach();
    }

    /*
    |--------------------------------------------------------------------------
    | IMAGES for person processing
    |--------------------------------------------------------------------------
    */

    /**
     * Updates images specified in form request for the person
     * @param array $request
     * @param Person $currentPerson
     */
    public static function processImages(array $request, Person $currentPerson)
    {
        /* Delete images if they are specified */
        if (Arr::has($request, 'imagesToDelete')) {
            Image::deleteImages($request['imagesToDelete']);
        }

        /* Add images if they are specified */
        if (Arr::has($request, 'images')) {
            $currentPerson->addImages($request['images'], $currentPerson);
        }
        $currentPerson->touch();
    }

    /**
     * Adds specified images to the current person
     * @param array $images
     * @param Person $currentPerson
     */
    public static function addImages(array $images, Person $currentPerson)
    {
        $imagesToAdd = Image::saveImages($images, $currentPerson->id);

        /* Add the image to the current person */
        $currentPerson->images()->saveMany($imagesToAdd);
    }
}
