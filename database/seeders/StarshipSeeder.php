<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Starship;
use App\Repositories\RepositoryInterface;
use App\Repositories\StarshipRepository\StarshipRepositoryInterface;
use Illuminate\Database\Seeder;

class StarshipSeeder extends Seeder
{
    /**
     * @var StarshipRepositoryInterface
     */
    protected StarshipRepositoryInterface $starshipRepository;

    /**
     * Run the database seeds.
     *
     * @param StarshipRepositoryInterface $starshipRepository
     * @return void
     */
    public function run(StarshipRepositoryInterface $starshipRepository)
    {
        $this->starshipRepository = $starshipRepository;

        /* API address from where to get data */
        $apiAddress = config('app.starshipsApiSource');

        /* Seeding running */
        $this->seedStarships($apiAddress);
    }

    /**
     * Seeds starships to starships table in DB
     * @param string $apiRequest
     * @param array $starshipsToSeed
     */
    private function seedStarships(string $apiRequest, array $starshipsToSeed = [])
    {
        $starshipRequest = json_decode(file_get_contents($apiRequest, true));

        $starships = $starshipRequest->results;
        foreach ($starships as $starship) {

            $starshipsToSeed[] =
                [
                    'name' => $starship->name,
                    'model' => $starship->model,
                    'manufacturer' => $starship->manufacturer,
                    'cost_in_credits' => $starship->cost_in_credits,
                    'length' => $starship->length,
                    'max_atmosphering_speed' => $starship->max_atmosphering_speed,
                    'passengers' => $starship->passengers,
                    'crew' => $starship->crew,
                    'cargo_capacity' => $starship->cargo_capacity,
                    'consumables' => $starship->consumables,
                    'hyperdrive_rating' => $starship->hyperdrive_rating,
                    'mglt' => $starship->MGLT,
                    'starship_class' => $starship->starship_class,
                    'created_at' => date('Y-m-d H:i:s', strtotime($starship->created)),
                    'updated_at' => date('Y-m-d H:i:s', strtotime($starship->edited)),
                    'url' => $starship->url,
                ];
        }
        /* If there are more than one pages at API resource */
        if ($starshipRequest->next) {
            $this->seedStarships($starshipRequest->next, $starshipsToSeed);
        } else {
            $this->starshipRepository->addAll($starshipsToSeed);
        }
    }
}
