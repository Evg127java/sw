<?php

namespace App\Models;

use App\Http\Requests\PersonFormRequest;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    /* Attributes for a default person's model */
    protected $attributes = [
        'name' => 'name',
        'height' => 0,
        'mass' => 0,
        'hair_color' => 'n/a',
        'birth_year' => 0,
        'url' => 'none',
        'gender_id' => 1,
        'homeworld_id' => 1,
    ];

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

    /**
     * Makes a new person's model
     * @param PersonFormRequest $request validated request data
     */
    public static function createNewPerson(PersonFormRequest $request)
    {
        $defaultPerson = self::create();
        $defaultPerson->updatePerson($request);
    }

    /**
     * Updates person's with passed data
     * @param PersonFormRequest $request validated request data
     */
    public function updatePerson(PersonFormRequest $request)
    {
        $this->update($request->validationData());

        $this->updateFilmsForPerson();
        $this->updateImagesForPerson();

        if ($this->isDirty()) {
            $this->save();
        }
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


    //-------------Related person's films processing-------------------//

    /**
     * Updates the current person's films set due to the request content
     */
    public function updateFilmsForPerson()
    {
        request('films') ? $this->addFilmsToPerson() : $this->removeAllFilmsFromPerson();
    }

    /**
     * Adds films from the request with the current person
     */
    public function addFilmsToPerson()
    {
        $this->films()->sync(request('films'));
    }

    /**
     * Removes films of the request of the current person
     */
    public function removeAllFilmsFromPerson()
    {
        $this->films()->detach();
    }
}
