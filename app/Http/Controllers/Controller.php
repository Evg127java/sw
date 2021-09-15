<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Gender;
use App\Models\Homeworld;
use App\Models\Person;
use App\Repositories\RepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected RepositoryInterface $homeworldRepository;
    protected RepositoryInterface $genderRepository;

    public function __construct(
        RepositoryInterface $repository,
        Gender $gender,
        Homeworld $homeworld
    )
    {
        ($this->genderRepository = $repository)->setModel($gender);
        ($this->homeworldRepository = clone($repository))->setModel($homeworld);
    }
}
