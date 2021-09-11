<?php

namespace Database\Seeders;

use App\Models\Homeworld;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

/**
 * Class HomeworldSeeder
 * @package Database\Seeders
 */
class HomeworldSeeder extends Seeder
{
    protected $homeworldRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Homeworld $homeworld
     * @return void
     */
    public function run(RepositoryInterface $repository, Homeworld $homeworld)
    {
        ($this->homeworldRepository = $repository)->setModel($homeworld);

        /* API address from where to get data */
        $apiAddress = config('app.apiBaseSource').'planets';

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
            $this->homeworldRepository->addAll($homeworldsToSeed);
        }
    }
}
