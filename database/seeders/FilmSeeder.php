<?php

namespace Database\Seeders;

use App\Repositories\FilmRepository\FilmRepositoryInterface;
use Http;
use Illuminate\Database\Seeder;

/**
 * Class FilmSeeder
 * @package Database\Seeders
 */
class FilmSeeder extends Seeder
{
    protected FilmRepositoryInterface $filmRepository;

    /**
     * Run the database seeds.
     *
     * @param FilmRepositoryInterface $filmRepository
     * @return void
     */
    public function run(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
        /* API address from where to get data */
        $apiAddress = config('app.filmsApiSource');

        /* Seeding running */
        $this->seedFilms($apiAddress);

    }

    /**
     * Seeds films to films table in DB
     * @param string $apiAddress address from where to get data
     */
    private function seedFilms(string $apiAddress)
    {
        $link = $apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $filmsToSeed = [];
            foreach ($request->results as $film) {

                $filmsToSeed[] =
                    [
                        'title' => $film->title,
                        'episode_id' => $film->episode_id,
                        'opening_crawl' => $film->opening_crawl,
                        'director' => $film->director,
                        'producer' => $film->producer,
                        'release_date' => $film->release_date,
                        'created_at' => date('Y-m-d H:i:s', strtotime($film->created)),
                        'updated_at' => date('Y-m-d H:i:s', strtotime($film->edited)),
                        'url' => $film->url,
                    ];
            }
            $this->filmRepository->saveMany($filmsToSeed);

            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
