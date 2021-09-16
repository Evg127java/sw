<?php

namespace Database\Seeders;

use App\Models\Homeworld;
use App\Repositories\HomeworldRepository\HomeworldRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class HomeworldSeeder
 * @package Database\Seeders
 */
class HomeworldSeeder extends Seeder
{
    protected HomeworldRepositoryInterface $homeworldRepository;

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
        $homeworldsToSeed = [];
        $request = json_decode(\Http::get($apiAddress));

        $planets = $request->results;
        foreach ($planets as $planet) {
            $homeworldsToSeed[] = ['name' => $planet->name];
        }
        $this->homeworldRepository->addAll($homeworldsToSeed);
        /* If there is more than one page at API resource */
        if ($request->next) {
            $this->seedHomeworlds($request->next);
        }
    }
}
