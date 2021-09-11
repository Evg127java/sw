<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Person;
use App\Models\Starship;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

class PersonStarshipSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $filmRepository;
    /**
     * @var RepositoryInterface
     */
    protected $starshipRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Person $person
     * @param Starship $starship
     * @return void
     */
    public function run(RepositoryInterface $repository, Person $person, Starship $starship)
    {
        ($this->filmRepository = $repository)->setModel($person);
        ($this->starshipRepository = clone($repository))->setModel($starship);

        $apiAddress = config('app.apiBaseSource').'starships';
        $this->bindPeopleToStarships($apiAddress);
    }

    /**
     * Binds people to starships as relations
     * @param $apiAddress
     */
    private function bindPeopleToStarships($apiAddress)
    {
        $starshipRequest = json_decode(file_get_contents($apiAddress, true));

        $starships = $starshipRequest->results;
        foreach ($starships as $starship) {
            foreach ($starship->pilots as $pilotLink) {
                $starship = $this->starshipRepository->getOneByColumnValue('name', $starship->name);
                $pilotId = preg_split('~\/~', $pilotLink)[5];
                $pilot = $this->filmRepository->getOneById($pilotId);
                $starship->people()->attach($pilot);
            }
        }
        if ($starshipRequest->next) {
            $this->bindPeopleToStarships($starshipRequest->next);
        }
    }
}
