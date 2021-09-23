<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Specie;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\SpecieRepository\SpecieRepositoryInterface;
use DB;
use Http;
use Illuminate\Database\Seeder;

class FilmSpecieSeeder extends Seeder
{
    /**
     * @var FilmRepositoryInterface
     */
    protected FilmRepositoryInterface $filmRepository;
    /**
     * @var SpecieRepositoryInterface
     */
    protected SpecieRepositoryInterface $specieRepository;

    /**
     * Run the database seeds.
     *
     * @param SpecieRepositoryInterface $specieRepository
     * @param FilmRepositoryInterface $filmRepository
     * @return void
     */
    public function run(SpecieRepositoryInterface $specieRepository, FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->specieRepository = $specieRepository;

        $apiAddress = config('app.speciesApiSource');
        $this->bindFilmsToSpecies($apiAddress);
    }

    /**
     * Binds films to species as relations
     * @param $apiAddress
     */
    private function bindFilmsToSpecies($apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));

            $dateTime = date('Y-m-d H:i:s', strtotime('now'));
            foreach ($request->results as $specie) {
                $dataToInsert = [];
                foreach ($specie->films as $filmLink) {
                    $specie = $this->specieRepository->getOneByName($specie->name);
                    $filmId = preg_split('~/~', $filmLink)[config('app.linkPartNumber')];
                    $dataToInsert[] = [
                        'specie_id' => $specie->getId(),
                        'film_id' => $filmId,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
                DB::table('film_specie')->insertOrIgnore($dataToInsert);
            }
            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
