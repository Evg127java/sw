<?php

namespace Database\Seeders;

use App\Repositories\FilmRepository;
use App\Repositories\PersonRepository;
use Illuminate\Database\Seeder;

/**
 * Class FilmPersonSeeder
 * @package Database\Seeders
 */
class FilmPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apiAddress = 'https://swapi.dev/api/people';
        $this->bindFilmsToPeople($apiAddress);
    }

    private function bindFilmsToPeople($apiAddress)
    {
        $personRepository = new PersonRepository();
        $filmRepository = new FilmRepository();
        $personRequest = json_decode(file_get_contents($apiAddress, true));

        $people = $personRequest->results;
        foreach ($people as $person) {
            foreach ($person->films as $filmLink) {
                $person = $personRepository->getOneByName($person->name);
                $filmId = preg_split('~\/~', $filmLink)[5];
                $film = $filmRepository->getOneById($filmId);
                $person->films()->attach($film);
            }
        }
        if ($personRequest->next) {
            $this->bindFilmsToPeople($personRequest->next);
        }
    }
}
