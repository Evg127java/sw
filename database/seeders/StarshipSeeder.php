<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Starship;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

class StarshipSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $starshipRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Starship $starship
     * @return void
     */
    public function run(RepositoryInterface $repository, Starship $starship)
    {
        ($this->starshipRepository = clone($repository))->setModel($starship);

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
