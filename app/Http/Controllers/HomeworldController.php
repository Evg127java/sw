<?php

namespace App\Http\Controllers;

use App\Models\Homeworld;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeworldController extends Controller
{
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
            ->getAllPeopleByParameter('homeworld_id', $homeworld->id, ['films', 'images'], true);
        $homeworlds = $this->homeworldRepository->getAll();

        return view('homeworld',
            [
                'homeworlds' => $homeworlds,
                'people' => $people,
                'homeworldName' => $homeworld->name
            ]);
    }
}
