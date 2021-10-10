<?php

namespace Database\Seeders;

use App\Repositories\StarshipRepository\StarshipRepositoryInterface;
use Http;
use Illuminate\Database\Seeder;

class StarshipSeeder extends Seeder
{
    /**
     * @var StarshipRepositoryInterface
     */
    private StarshipRepositoryInterface $starshipRepository;

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
     * @param string $apiAddress
     */
    private function seedStarships(string $apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $starshipsToSeed = [];

            foreach ($request->results as $starship) {

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
            $this->starshipRepository->saveMany($starshipsToSeed);

            /* If there are more than one pages at API resource */
            $link = $request->next ?? null;
        }
    }
}
