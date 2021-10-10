<?php

namespace Database\Seeders;

use App\Repositories\GenderRepository\GenderRepositoryInterface;
use Http;
use Illuminate\Database\Seeder;

/**
 * Class GenderSeeder
 * @package Database\Seeders
 */
class GenderSeeder extends Seeder
{
    private GenderRepositoryInterface $genderRepository;

    /**
     * Run the database seeds.
     *
     * @param GenderRepositoryInterface $genderRepository
     * @return void
     */
    public function run(GenderRepositoryInterface $genderRepository)
    {
        $this->genderRepository = $genderRepository;

        /* API address from where to get data */
        $apiAddress = config('app.peopleApiSource');

        /* Seeding running */
        $this->seedGenders($apiAddress);
    }

    /**
     * Seeds genders to genders table in DB
     * @param string $apiAddress
     */
    private function seedGenders(string $apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $gendersToSeed = [];
            foreach ($request->results as $person) {
                $gendersToSeed[] =
                    [
                        'type' => $person->gender,
                        'created_at' => date('Y-m-d H:i:s', strtotime('now')),
                        'updated_at' => date('Y-m-d H:i:s', strtotime('now')),
                    ];
            }
            $this->genderRepository->saveMany($gendersToSeed);

            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
