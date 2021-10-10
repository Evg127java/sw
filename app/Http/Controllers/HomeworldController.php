<?php

namespace App\Http\Controllers;

use App\Repositories\HomeworldRepository\HomeworldRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeworldController extends Controller
{
    protected HomeworldRepositoryInterface $homeworldRepository;

    /**
     * HomeworldController constructor.
     * @param HomeworldRepositoryInterface $homeworldRepository
     */
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
     * @param PersonRepositoryInterface $personRepository
     * @return Application|Factory|View
     */
    public function show(PersonRepositoryInterface $personRepository)
    {
        $homeworld = $this->homeworldRepository->getOneByName(request('name'));
        $people = $personRepository
            ->getAllByHomeworld($homeworld->getId(), [], config('app.peoplePerPageOnPlanet'));
        $homeworlds = $this->homeworldRepository->getAll();

        return view('homeworld',
            [
                'homeworlds' => $homeworlds,
                'people' => $people,
                'homeworldName' => $homeworld->getName(),
            ]);
    }
}
