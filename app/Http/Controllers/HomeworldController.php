<?php

namespace App\Http\Controllers;

use App\Models\Homeworld;
use App\Repositories\HomeworldRepository\HomeworldRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeworldController extends Controller
{
    protected HomeworldRepositoryInterface $homeworldRepository;

    public function __construct(HomeworldRepositoryInterface $homeworldRepository)
    {
        $this->homeworldRepository = $homeworldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $homeworlds = $this->homeworldRepository->getAll();
        return view('homeworld', ['homeworlds' => $homeworlds]);

    }

    /**
     * Displays people only from the specified homeworld
     * @param Homeworld $homeworld homeworld instance
     * @param PersonRepositoryInterface $personRepository
     * @return Application|Factory|View
     */
    public function show(Homeworld $homeworld, PersonRepositoryInterface $personRepository)
    {
        $people = $personRepository
            ->getAllByParameter('homeworld_id', $homeworld->id, ['films', 'images'], true);
        $homeworlds = $this->homeworldRepository->getAll();

        return view('homeworld',
            [
                'homeworlds' => $homeworlds,
                'people' => $people,
                'homeworldName' => $homeworld->name
            ]);
    }
}
