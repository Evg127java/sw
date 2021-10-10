<?php

namespace Database\Seeders;

use App\Repositories\GenderRepository\GenderRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use Http;
use Illuminate\Database\Seeder;

/**
 * Class PersonSeeder
 * @package Database\Seeders
 */
class PersonSeeder extends Seeder
{
    private GenderRepositoryInterface $genderRepository;
    private PersonRepositoryInterface $personRepository;

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

        /* Seeding running */
        $this->seedPeople(config('app.peopleApiSource'));
    }

    /**
     * Seeds people to people table in DB
     * @param string $apiAddress
     */
    private function seedPeople(string $apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $peopleToSeed = [];

            foreach ($request->results as $person) {
                $genderId = $this->genderRepository->getIdByType($person->gender);
                $homeworldId = preg_split('~/~', $person->homeworld)[config('app.linkPartNumber')];
                $personId = preg_split('~/~', $person->url)[config('app.linkPartNumber')];

                $peopleToSeed[] =
                    [
                        'id' => $personId,
                        'name' => $person->name,
                        'height' => $person->height,
                        'mass' => $person->mass,
                        'hair_color' => $person->hair_color,
                        'skin_color' => $person->skin_color,
                        'eye_color' => $person->eye_color,
                        'birth_year' => $person->birth_year,
                        'gender_id' => $genderId,
                        'homeworld_id' => $homeworldId,
                        'created_at' => date('Y-m-d H:i:s', strtotime($person->created)),
                        'updated_at' => date('Y-m-d H:i:s', strtotime($person->edited)),
                        'url' => $person->url,
                    ];
            }
            $this->personRepository->saveMany($peopleToSeed);
            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
