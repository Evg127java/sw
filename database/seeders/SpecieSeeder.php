<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Specie;
use App\Models\Vehicle;
use App\Repositories\RepositoryInterface;
use App\Repositories\SpecieRepository\SpecieRepositoryInterface;
use Illuminate\Database\Seeder;

class SpecieSeeder extends Seeder
{
    /**
     * @var SpecieRepositoryInterface
     */
    protected SpecieRepositoryInterface $specieRepository;

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
     * @param string $apiRequest
     */
    private function seedSpecies(string $apiRequest)
    {
        $speciesToSeed = [];
        $specieRequest = json_decode(\Http::get($apiRequest));

        $species = $specieRequest->results;
        foreach ($species as $specie) {

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
        if ($specieRequest->next) {
            $this->seedSpecies($specieRequest->next);
        }
    }
}
