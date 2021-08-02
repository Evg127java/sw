<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Gender;
use App\Models\Homeworld;
use App\Models\Person;
use App\Repository\RepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected RepositoryInterface $personRepository;
    protected RepositoryInterface $filmRepository;
    protected RepositoryInterface $homeworldRepository;
    protected RepositoryInterface $genderRepository;

    public function __construct(
        RepositoryInterface $repository,
        Person $person,
        Film $film,
        Gender $gender,
        Homeworld $homeworld
    )
    {
        ($this->personRepository = $repository)->setModel($person);
        ($this->filmRepository = clone($repository))->setModel($film);
        ($this->genderRepository = clone($repository))->setModel($gender);
        ($this->homeworldRepository = clone($repository))->setModel($homeworld);
    }
}
