<?php

namespace Database\Seeders;

use App\Repositories\StarshipRepository\StarshipRepositoryInterface;
use DB;
use Http;
use Illuminate\Database\Seeder;

class FilmStarshipSeeder extends Seeder
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

        $apiAddress = config('app.starshipsApiSource');
        $this->bindFilmsToStarships($apiAddress);
    }

    /**
     * Binds films to starships as relations
     * @param $apiAddress
     */
    private function bindFilmsToStarships($apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $dateTime = date('Y-m-d H:i:s', strtotime('now'));

            foreach ($request->results as $starshipFromApi) {
                $dataToInsert = [];
                foreach ($starshipFromApi->films as $filmLink) {
                    $starship = $this->starshipRepository->getOneByName($starshipFromApi->name);
                    $filmId = preg_split('~/~', $filmLink)[config('app.linkPartNumber')];
                    $dataToInsert[] = [
                        'starship_id' => $starship->getId(),
                        'film_id' => $filmId,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
                DB::table('film_starship')->insertOrIgnore($dataToInsert);
            }
            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
