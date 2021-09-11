<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class GenderSeeder
 * @package Database\Seeders
 */
class GenderSeeder extends Seeder
{
    protected $genderRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Gender $gender
     * @return void
     */
    public function run(RepositoryInterface $repository, Gender $gender)
    {
        ($this->genderRepository = $repository)->setModel($gender);

        /* API address from where to get data */
        $apiAddress = config('app.apiBaseSource').'people';

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
            $this->genderRepository->addAll($gendersToSeed);
        }
    }
}
