<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Person;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class FilmPersonSeeder
 * @package Database\Seeders
 */
class FilmPersonSeeder extends Seeder
{
    protected $filmRepository;
    protected PersonRepositoryInterface $personRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param PersonRepositoryInterface $personRepository
     * @param Film $film
     * @param Person $person
     * @return void
     */
    public function run(RepositoryInterface $repository, PersonRepositoryInterface $personRepository, Film $film, Person $person)
    {
        ($this->filmRepository = $repository)->setModel($film);
        $this->personRepository = $personRepository;

        $apiAddress = config('app.peopleApiSource');
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
                $person = $this->personRepository
                    ->getPersonByParameterAndValue('name', $person->name);
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
