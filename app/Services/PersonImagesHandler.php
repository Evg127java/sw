<?php


namespace App\Services;


use App\Entities\PersonEntity;
use App\Models\Image;
use Arr;

class PersonImagesHandler
{
    private array $request;
    private PersonEntity $person;

    /**
     * PersonImagesHandler constructor.
     * @param array $request
     * @param PersonEntity $person
     */
    public function __construct(PersonEntity $person, array $request)
    {
        $this->request = $request;
        $this->person = $person;
    }

    /**
     * Updates images specified in form request for the person
     */
    public function run()
    {
        $request = $this->request;
        $person = $this->person;
        /* Delete images if they are specified */
        if (Arr::has($request, 'imagesToDelete')) {
            Image::deleteImages($request['imagesToDelete']);
            unset($request['imagesToDelete']);
        }

        /* Add images if they are specified */
        if (Arr::has($request, 'images')) {
            $this->addImages($request['images'], $person);
            unset($request['images']);
        }
        return $request;
    }

    /**
     * Adds specified images to the current person
     * @param array $images
     * @param PersonEntity $person
     */
    public function addImages(array $images, PersonEntity $person)
    {
        /* Add the image to the current person */
        Image::saveImages($images, $person->getId());
    }
}
