<?php


namespace App\Services;


use App\Entities\PersonEntity;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use Arr;

class PersonFilmsHandler
{
    private array $request;
    private PersonEntity $person;
    private FilmRepositoryInterface $filmRepository;

    /**
     * PersonFilmsHandler constructor.
     * @param array $request
     * @param PersonEntity $person
     */
    public function __construct(PersonEntity $person, array $request)
    {
        $this->request = $request;
        $this->person = $person;
        $this->filmRepository = app(FilmRepositoryInterface::class);
    }

    /**
     * Updates films specified in form request for the person
     */
    public function run()
    {
        $request = $this->request;
        $person = $this->person;
        if (Arr::exists($request, 'films')) {
            $this->addFilms($request['films'], $person);
        } else {
            $this->removeAllPersonFilms($person);
            unset($request['films']);
        }
        return $request;
    }

    /**
     * Adds passed films to the current person
     * @param int[] $films films' ids
     * @param PersonEntity $person
     */
    public function addFilms(array $films, PersonEntity $person)
    {
        $filmsIds = $this->filmRepository->getAllFilmsIdsByPersonId($person->getId());
        $person = $this->removeAllPersonFilms($person);
        $data = array_merge($films, $filmsIds);
        $person->setFilms(array_unique($data));
    }

    /**
     * Deletes all the films related to the current person
     * @param PersonEntity $person
     * @return PersonEntity
     */
    public function removeAllPersonFilms(PersonEntity $person)
    {
        $person->setFilms([]);
        $this->filmRepository->removeAllByPersonId($person->getId());
        return $person;
    }
}
