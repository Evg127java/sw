<?php


namespace App\Services;


use App\Http\Requests\PersonFormRequest;
use App\Models\Image;

/**
 * Class PersonServices
 * @package App\Services
 */
class PersonServices
{

    private $person;


    /**
     * PersonServices constructor.
     * @param $person
     */
    public function __construct($person)
    {
        $this->person = $person;
    }


    //-------------------FILMS for person processing-------------------//


    /**
     * Updates films specified in form request for the person
     * @param PersonFormRequest $request data to update
     */
    public function updateFilmsForPerson(PersonFormRequest $request)
    {
        $request->films ? $this->addFilmsToPerson($request) : $this->removeAllFilmsFromPerson();
    }

    /**
     * Adds passed films to the current person
     * @param PersonFormRequest $request data to add
     */
    public function addFilmsToPerson(PersonFormRequest $request)
    {
        $this->person->films()->sync($request->films);
    }

    /**
     * Deletes all the films related to the current person
     */
    public function removeAllFilmsFromPerson()
    {
        $this->person->films()->detach();
    }


    //------------IMAGES for person processing----------------------//


    /**
     * Updates images specified in form request for the person
     * @param PersonFormRequest $request
     */
    public function updateImagesForPerson(PersonFormRequest $request)
    {
        /* Delete images if they are specified */
        $imagesToDelete = $request->imagesToDelete;
        if (!empty($imagesToDelete)) {
            Image::deleteImages($imagesToDelete);
        }

        /* Add images if they are specified */
        $imagesToAdd = $request->images;
        if (!empty($imagesToAdd)) {
            $this->addImagesToPerson($imagesToAdd);
        }
    }

    /**
     * Adds specified images to the current person
     * @param array $images
     */
    public function addImagesToPerson(array $images)
    {
        $person = $this->person;
        $imagesToAdd = Image::saveImages($images, $person->id);

        /* Add the image to the current person */
        $person->images()->saveMany($imagesToAdd);
    }
}
