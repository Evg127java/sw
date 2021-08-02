<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Person;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class FilmPersonSeeder
 * @package Database\Seeders
 */
class FilmPersonSeeder extends Seeder
{
    protected $filmRepository;
    protected $personRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Film $film
     * @param Person $person
     * @return void
     */
    public function run(RepositoryInterface $repository, Film $film, Person $person)
    {
        ($this->filmRepository = $repository)->setModel($film);
        ($this->personRepository = clone($repository))->setModel($person);

        $apiAddress = 'https://swapi.dev/api/people';
        $this->bindFilmsToPeople($apiAddress);
    }

    /**
     * Binds films to people as relations
     * @param $apiAddress
     */
    private function bindFilmsToPeople($apiAddress)
    {
        $personRequest = json_decode(file_get_contents($apiAddress, true));

        $people = $personRequest->results;
        foreach ($people as $person) {
            foreach ($person->films as $filmLink) {
                $person = $this->personRepository->getOneByColumnValue('name', $person->name);
                $filmId = preg_split('~\/~', $filmLink)[5];
                $film = $this->filmRepository->getOneById($filmId);
                $person->films()->attach($film);
            }
        }
        if ($personRequest->next) {
            $this->bindFilmsToPeople($personRequest->next);
        }
    }
}
