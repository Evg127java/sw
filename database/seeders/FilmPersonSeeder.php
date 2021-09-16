<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Person;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class FilmPersonSeeder
 * @package Database\Seeders
 */
class FilmPersonSeeder extends Seeder
{
    protected FilmRepositoryInterface $filmRepository;
    protected PersonRepositoryInterface $personRepository;

    /**
     * Run the database seeds.
     *
     * @param PersonRepositoryInterface $personRepository
     * @param FilmRepositoryInterface $filmRepository
     * @return void
     */
    public function run(PersonRepositoryInterface $personRepository, FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
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
        $personRequest = json_decode(\Http::get($apiAddress));

        $people = $personRequest->results;
        foreach ($people as $person) {
            foreach ($person->films as $filmLink) {
                $person = $this->personRepository
                    ->getPersonByParameterAndValue('name', $person->name);
                $filmId = preg_split('~\/~', $filmLink)[config('app.linkPartNumber')];
                $film = $this->filmRepository->getOneById($filmId);
                $person->films()->attach($film);
            }
        }
        if ($personRequest->next) {
            $this->bindFilmsToPeople($personRequest->next);
        }
    }
}
