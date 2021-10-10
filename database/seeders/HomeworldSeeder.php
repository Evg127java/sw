<?php

namespace Database\Seeders;

use App\Repositories\HomeworldRepository\HomeworldRepositoryInterface;
use Http;
use Illuminate\Database\Seeder;

/**
 * Class HomeworldSeeder
 * @package Database\Seeders
 */
class HomeworldSeeder extends Seeder
{
    private HomeworldRepositoryInterface $homeworldRepository;

    /**
     * Run the database seeds.
     *
     * @param HomeworldRepositoryInterface $homeworldRepository
     * @return void
     */
    public function run(HomeworldRepositoryInterface $homeworldRepository)
    {
        $this->homeworldRepository = $homeworldRepository;

        /* API address from where to get data */
        $apiAddress = config('app.homeworldsApiSource');

        /* Seeding running */
        $this->seedHomeworlds($apiAddress);
    }

    /**
     * Seeds homeworlds to homeworlds table in DB
     * @param string $apiAddress
     */
    private function seedHomeworlds(string $apiAddress)
    {
        $link = $apiAddress;
        while ($link) {
            $request = json_decode(Http::get($link));
            $homeworldsToSeed = [];
            foreach ($request->results as $planet) {
                $homeworldsToSeed[] =
                    [
                        'name' => $planet->name,
                        'rotation_period' => $planet->rotation_period,
                        'orbital_period' => $planet->orbital_period,
                        'diameter' => $planet->diameter,
                        'climate' => $planet->climate,
                        'gravity' => $planet->gravity,
                        'terrain' => $planet->terrain,
                        'surface_water' => $planet->surface_water,
                        'population' => $planet->population,
                        'created_at' => date('Y-m-d H:i:s', strtotime($planet->created)),
                        'updated_at' => date('Y-m-d H:i:s', strtotime($planet->edited)),
                        'url' => $planet->url,
                    ];
            }
            $this->homeworldRepository->saveMany($homeworldsToSeed);

            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
