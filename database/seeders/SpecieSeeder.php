<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Specie;
use App\Models\Vehicle;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Seeder;

class SpecieSeeder extends Seeder
{
    /**
     * @var RepositoryInterface
     */
    protected $specieRepository;

    /**
     * Run the database seeds.
     *
     * @param RepositoryInterface $repository
     * @param Specie $specie
     * @return void
     */
    public function run(RepositoryInterface $repository, Specie $specie)
    {
        ($this->specieRepository = $repository)->setModel($specie);

        /* API address from where to get data */
        $apiAddress = config('app.apiBaseSource').'species';

        /* Seeding running */
        $this->seedSpecies($apiAddress);
    }

    /**
     * Seeds species to species table in DB
     * @param string $apiRequest
     * @param array $speciesToSeed
     */
    private function seedSpecies(string $apiRequest, array $speciesToSeed = [])
    {
        $specieRequest = json_decode(file_get_contents($apiRequest, true));

        $species = $specieRequest->results;
        //dd($species);
        foreach ($species as $specie) {

            $homeworldId = is_null($specie->homeworld) ?
                null : preg_split('~\/~', $specie->homeworld)[5];

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
                    'homeworld' => $homeworldId,
                    'language' => $specie->language,
                    'created_at' => date('Y-m-d H:i:s', strtotime($specie->created)),
                    'updated_at' => date('Y-m-d H:i:s', strtotime($specie->edited)),
                    'url' => $specie->url,
                ];
        }
        /* If there are more than one pages at API resource */
        if ($specieRequest->next) {
            $this->seedSpecies($specieRequest->next, $speciesToSeed);
        } else {
            $this->specieRepository->addAll($speciesToSeed);
        }
    }
}
