<?php

namespace Database\Seeders;

use App\Repositories\GenderRepository\GenderRepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class GenderSeeder
 * @package Database\Seeders
 */
class GenderSeeder extends Seeder
{
    protected GenderRepositoryInterface $genderRepository;

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
        $gendersToSeed = [];
        $request = json_decode(\Http::get($apiAddress));

        $people = $request->results;
        foreach ($people as $person) {
            $gendersToSeed[] = ['type' => $person->gender];
        }
        $this->genderRepository->saveMany($gendersToSeed);
        /* If there is more than one page at API resource */
        if ($request->next) {
            $this->seedGenders($request->next);
        }
    }
}
