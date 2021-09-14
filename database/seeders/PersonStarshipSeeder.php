<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Person;
use App\Models\Starship;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Seeder;

class PersonStarshipSeeder extends Seeder
{
    /**
     * @var PersonRepositoryInterface
     */
    protected $personRepository;
    /**
     * @var RepositoryInterface
     */
    protected $starshipRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param PersonRepositoryInterface $personRepository
     * @param Starship $starship
     * @return void
     */
    public function run(RepositoryInterface $repository, PersonRepositoryInterface $personRepository, Starship $starship)
    {
        $this->personRepository = $personRepository;
        ($this->starshipRepository = $repository)->setModel($starship);

        $apiAddress = config('app.starshipsApiSource');
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
                $pilot = $this->personRepository->getPersonById($pilotId);
                $starship->people()->attach($pilot);
            }
        }
        if ($starshipRequest->next) {
            $this->bindPeopleToStarships($starshipRequest->next);
        }
    }
}
