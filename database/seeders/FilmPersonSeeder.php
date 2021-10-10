<?php

namespace Database\Seeders;

use App\Repositories\PersonRepository\PersonRepositoryInterface;
use DB;
use Http;
use Illuminate\Database\Seeder;

/**
 * Class FilmPersonSeeder
 * @package Database\Seeders
 */
class FilmPersonSeeder extends Seeder
{
    private PersonRepositoryInterface $personRepository;
    private string $apiAddress;

    /**
     * Run the database seeds.
     *
     * @param PersonRepositoryInterface $personRepository
     * @return void
     */
    public function run(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;

        $this->apiAddress = config('app.peopleApiSource');
        $this->bindFilmsToPeople();
    }

    /**
     * Binds films to people as relations
     */
    private function bindFilmsToPeople()
    {
        $link = $this->apiAddress;

        while ($link) {
            $request = json_decode(Http::get($link));
            $dateTime = date('Y-m-d H:i:s', strtotime('now'));

            foreach ($request->results as $personFromApi) {
                $dataToInsert = [];
                foreach ($personFromApi->films as $filmLink) {
                    $person = $this->personRepository->getOneByName($personFromApi->name);
                    $filmId = preg_split('~/~', $filmLink)[config('app.linkPartNumber')];
                    $dataToInsert[] = [
                        'person_id' => $person->getId(),
                        'film_id' => $filmId,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
                DB::table('film_person')->insertOrIgnore($dataToInsert);
            }
            /* If there is more than one page at API resource */
            $link = $request->next ?? null;
        }
    }
}
