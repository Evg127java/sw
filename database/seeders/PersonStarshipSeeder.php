<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Person;
use App\Models\Starship;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\StarshipRepository\StarshipRepositoryInterface;
use Illuminate\Database\Seeder;

class PersonStarshipSeeder extends Seeder
{
    /**
     * @var PersonRepositoryInterface
     */
    protected PersonRepositoryInterface $personRepository;
    /**
     * @var StarshipRepositoryInterface
     */
    protected StarshipRepositoryInterface $starshipRepository;

    /**
     * Run the database seeds.
     *
     * @param PersonRepositoryInterface $personRepository
     * @param StarshipRepositoryInterface $starshipRepository
     * @return void
     */
    public function run(PersonRepositoryInterface $personRepository, StarshipRepositoryInterface $starshipRepository)
    {
        $this->personRepository = $personRepository;
        $this->starshipRepository = $starshipRepository;

        $apiAddress = config('app.starshipsApiSource');
        $this->bindPeopleToStarships($apiAddress);
    }

    /**
     * Binds people to starships as relations
     * @param $apiAddress
     */
    private function bindPeopleToStarships($apiAddress)
    {
        $starshipRequest = json_decode(\Http::get($apiAddress));

        $starships = $starshipRequest->results;
        foreach ($starships as $starship) {
            foreach ($starship->pilots as $pilotLink) {
                $starship = $this->starshipRepository->getOneByName('name', $starship->name);
                $pilotId = preg_split('~\/~', $pilotLink)[config('app.linkPartNumber')];
                $pilot = $this->personRepository->getOneById($pilotId);
                $starship->people()->attach($pilot);
            }
        }
        if ($starshipRequest->next) {
            $this->bindPeopleToStarships($starshipRequest->next);
        }
    }
}
