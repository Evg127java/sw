<?php

namespace App\Http\Controllers;

use App\Models\Homeworld;
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
     * @param Homeworld $homeworld      homeworld instance
     * @return Application|Factory|View
     */
    public function show(Homeworld $homeworld)
    {
        $people = $this->personRepository
            ->getAllByColumn('homeworld_id', $homeworld->id)
            ->paginate(5);
        $homeworlds = $this->homeworldRepository->getAll();

        return view('homeworld',
            [
                'homeworlds' => $homeworlds,
                'people' => $people,
                'homeworldName' => $homeworld->name
            ]);
    }
}
