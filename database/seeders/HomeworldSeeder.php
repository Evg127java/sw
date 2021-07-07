<?php

namespace Database\Seeders;

use App\Models\Homeworld;
use App\Repositories\HomeworldRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeworldSeeder
 * @package Database\Seeders
 */
class HomeworldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* API address from where to get data */
        $apiAddress = 'https://swapi.dev/api/planets';

        /* Seeding running */
        $this->seedHomeworlds($apiAddress);
    }

    /**
     * Seeds homeworlds to homeworlds table in DB
     * @param string $apiAddress
     * @param array $homeworldsToSeed
     */
    private function seedHomeworlds(string $apiAddress, array $homeworldsToSeed = [])
    {
        $homeworldRepository = new HomeworldRepository();
        $request = json_decode(file_get_contents($apiAddress, true));

        $planets = $request->results;
        foreach ($planets as $planet) {
            $homeworldsToSeed[] =
                [
                    'name' => $planet->name,
                ];
        }
        /* If there is more than one page at API resource */
        if ($request->next) {
            $this->seedHomeworlds($request->next, $homeworldsToSeed);
        } else {
            $homeworldRepository->addAll($homeworldsToSeed);
        }
    }
}
