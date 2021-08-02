<?php


namespace App\Services;


interface PersonServiceInterface
{
    //-------------------FILMS for person processing-------------------//

    /**
     * Runs a person's relation processes
     */
    public function processPersonRelations();

    /**
     * Updates films specified in form request for the person
     */
    public function processFilmsForPerson();

    /**
     * Adds passed films to the current person
     * @param $films
     */
    public function addFilmsToPerson(array $films);

    /**
     * Deletes all the films related to the current person
     */
    public function removeAllFilmsFromPerson();


    //------------IMAGES for person processing----------------------//


    /**
     * Updates images specified in form request for the person
     */
    public function processImagesForPerson();

    /**
     * Adds specified images to the current person
     * @param array $images
     */
    public function addImagesToPerson(array $images);
}
