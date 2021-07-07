<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Repositories\GenderRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class GenderSeeder
 * @package Database\Seeders
 */
class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* API address from where to get data */
        $apiAddress = 'https://swapi.dev/api/people';

        /* Seeding running */
        $this->seedGenders($apiAddress);
    }

    /**
     * Seeds genders to genders table in DB
     * @param string $apiAddress
     * @param array $gendersToSeed
     */
    private function seedGenders(string $apiAddress, array $gendersToSeed = [])
    {
        $genderRepository = new GenderRepository();
        $request = json_decode(file_get_contents($apiAddress, true));

        $people = $request->results;
        foreach ($people as $person) {
            $gendersToSeed[] =
                [
                    'type' => $person->gender,
                ];
        }
        /* If there is more than one page at API resource */
        if ($request->next) {
            $this->seedGenders($request->next, $gendersToSeed);
        } else {
            $genderRepository->addAll($gendersToSeed);
        }
    }
}
