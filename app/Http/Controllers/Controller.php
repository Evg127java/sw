<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\FilmRepositoryInterface;
use App\Repositories\Interfaces\GenderRepositoryInterface;
use App\Repositories\Interfaces\HomeworldRepositoryInterface;
use App\Repositories\Interfaces\PersonRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected PersonRepositoryInterface $personRepository;
    protected FilmRepositoryInterface $filmRepository;
    protected HomeworldRepositoryInterface $homeworldRepository;
    protected GenderRepositoryInterface $genderRepository;

    public function __construct(
        PersonRepositoryInterface $personRepository,
        FilmRepositoryInterface $filmRepository,
        GenderRepositoryInterface $genderRepository,
        HomeworldRepositoryInterface $homeworldRepository
    ) {
        $this->personRepository = $personRepository;
        $this->filmRepository = $filmRepository;
        $this->genderRepository = $genderRepository;
        $this->homeworldRepository = $homeworldRepository;
    }
}
