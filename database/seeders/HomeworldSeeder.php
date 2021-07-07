<?php

namespace Database\Seeders;

use App\Models\Homeworld;
use App\Repositories\HomeworldRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeworldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apiAddress = 'https://swapi.dev/api/planets';
        $this->seedHomeworlds($apiAddress);
    }

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
        if ($request->next) {
            $this->seedHomeworlds($request->next, $homeworldsToSeed);
        } else {
            $homeworldRepository->addAll($homeworldsToSeed);
        }
    }
}
