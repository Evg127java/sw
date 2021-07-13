<?php


namespace App\Services;


use App\Http\Requests\PersonFormRequest;
use App\Models\Image;
use App\Models\Person;
use Arr;

/**
 * Class PersonServices
 * @package App\Services
 */
class PersonServices
{
    private $person;
    private $request;

    /**
     * PersonServices constructor.
     * @param Person $person
     * @param array $request
     */
    public function __construct($person, array $request)
    {
        $this->person = $person;
        $this->request = $request;
    }

    //-------------------FILMS for person processing-------------------//

    /**
     * Runs a person's relation processes
     */
    public function processPersonRelations()
    {
        $this->processFilmsForPerson();
        $this->processImagesForPerson();
    }

    /**
     * Updates films specified in form request for the person
     */
    public function processFilmsForPerson()
    {
        $request = $this->request;
        Arr::exists($request, 'films') ?
            $this->addFilmsToPerson($request['films']) :
            $this->removeAllFilmsFromPerson();
    }

    /**
     * Adds passed films to the current person
     * @param $films
     */
    public function addFilmsToPerson(array $films)
    {
        $this->person->films()->sync($films);
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
     */
    public function processImagesForPerson()
    {
        $request = $this->request;
        /* Delete images if they are specified */
        if (Arr::has($request,'imagesToDelete')) {
            Image::deleteImages($request['imagesToDelete']);
        }

        /* Add images if they are specified */
        if (Arr::has($request,'images')) {
            $this->addImagesToPerson($request['images']);
        }
        $this->person->touch();
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
