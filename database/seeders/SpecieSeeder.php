<?php

namespace Database\Seeders;

use App\Repositories\SpecieRepository\SpecieRepositoryInterface;
use Http;
use Illuminate\Database\Seeder;

class SpecieSeeder extends Seeder
{
    /**
     * @var SpecieRepositoryInterface
     */
    private SpecieRepositoryInterface $specieRepository;

    /**
     * Run the database seeds.
     *
     * @param SpecieRepositoryInterface $specieRepository
     * @return void
     */
    public function run(SpecieRepositoryInterface $specieRepository)
    {
        $this->specieRepository = $specieRepository;

        /* API address from where to get data */
        $apiAddress = config('app.speciesApiSource');

        /* Seeding running */
        $this->seedSpecies($apiAddress);
    }

    /**
     * Seeds species to species table in DB
     * @param string $apiAddress
     */
    private function seedSpecies(string $apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $speciesToSeed = [];

            foreach ($request->results as $specie) {

                $homeworldId = is_null($specie->homeworld) ?
                    null : preg_split('~/~', $specie->homeworld)[config('app.linkPartNumber')];

                $speciesToSeed[] =
                    [
                        'name' => $specie->name,
                        'classification' => $specie->classification,
                        'designation' => $specie->designation,
                        'average_height' => $specie->average_height,
                        'skin_colors' => $specie->skin_colors,
                        'hair_colors' => $specie->hair_colors,
                        'eye_colors' => $specie->eye_colors,
                        'average_lifespan' => $specie->average_lifespan,
                        'homeworld_id' => $homeworldId,
                        'language' => $specie->language,
                        'created_at' => date('Y-m-d H:i:s', strtotime($specie->created)),
                        'updated_at' => date('Y-m-d H:i:s', strtotime($specie->edited)),
                        'url' => $specie->url,
                    ];
            }
            $this->specieRepository->saveMany($speciesToSeed);

            /* If there are more than one pages at API resource */
            $link = $request->next ?? null;
        }
    }
}
