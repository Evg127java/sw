<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Repositories\GenderRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apiAddress = 'https://swapi.dev/api/people';
        $this->seedGenders($apiAddress);
    }

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
        if ($request->next) {
            $this->seedGenders($request->next, $gendersToSeed);
        } else {
            $genderRepository->addAll($gendersToSeed);
        }
    }
}
