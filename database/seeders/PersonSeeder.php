<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Person;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class PersonSeeder
 * @package Database\Seeders
 */
class PersonSeeder extends Seeder
{
    protected $genderRepository;
    protected $personRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Gender $gender
     * @param Person $person
     * @return void
     */
    public function run(RepositoryInterface $repository, Gender $gender, Person $person)
    {
        ($this->personRepository = $repository)->setModel($person);
        ($this->genderRepository = clone($repository))->setModel($gender);

        /* API address from where to get data */
        $apiAddress = 'https://swapi.dev/api/people';

        /* Seeding running */
        $this->seedPeople($apiAddress);
    }

    /**
     * Seeds people to people table in DB
     * @param string $apiRequest
     * @param array $peopleToSeed
     */
    private function seedPeople(string $apiRequest, array $peopleToSeed = [])
    {
        $personRequest = json_decode(file_get_contents($apiRequest, true));

        $people = $personRequest->results;
        foreach ($people as $person) {
            $genderId = $this->genderRepository->getIdByColumnValue('type', $person->gender);
            $homeworldId = preg_split('~\/~', $person->homeworld)[5];

            $peopleToSeed[] =
                [
                    'name' => $person->name,
                    'height' => $person->height,
                    'mass' => $person->mass,
                    'hair_color' => $person->hair_color,
                    'birth_year' => $person->birth_year,
                    'gender_id' => $genderId,
                    'homeworld_id' => $homeworldId,
                    'created_at' => date('Y-m-d H:i:s', strtotime($person->created)),
                    'url' => $person->url,
                ];
        }
        /* If there is more than one page at API resource */
        if ($personRequest->next) {
            $this->seedPeople($personRequest->next, $peopleToSeed);
        } else {
            $this->personRepository->addAll($peopleToSeed);
        }
    }
}
