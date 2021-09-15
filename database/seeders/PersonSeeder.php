<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Person;
use App\Repositories\GenderRepository\GenderRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\RepositoryInterface;
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
     * @param GenderRepositoryInterface $genderRepository
     * @param PersonRepositoryInterface $personRepository
     * @return void
     */
    public function run(GenderRepositoryInterface $genderRepository, PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
        $this->genderRepository = $genderRepository;

        /* API address from where to get data */
        $apiAddress = config('app.peopleApiSource');

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
            $genderId = $this->genderRepository->getIdByParameter('type', $person->gender);
            $homeworldId = preg_split('~\/~', $person->homeworld)[5];
            $personId = preg_split('~\/~', $person->url)[5];

            $peopleToSeed[] =
                [
                    'id' => $personId,
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
            $this->personRepository->addAllPeople($peopleToSeed);
        }
    }
}
