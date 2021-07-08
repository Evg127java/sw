<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonFormRequest;
use App\Models\Film;
use App\Models\Gender;
use App\Models\Homeworld;
use App\Models\Person;
use App\Repositories\FilmRepository;
use App\Repositories\GenderRepository;
use App\Repositories\HomeworldRepository;
use App\Repositories\PersonRepository;
use App\Services\FilmServices;
use App\Services\ImageServices;
use App\Services\PersonServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Storage;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $people = $this->personRepository
            ->getAllByOrder('id', 'desc')
            ->paginate(10);
        return view('people', ['people' => $people]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('create',
            [
                'films' => $this->filmRepository->getAll(),
                'homeworlds' => $this->homeworldRepository->getAll(),
                'genders' => $this->genderRepository->getAll()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @return Application|RedirectResponse|Redirector
     */
    public function store()
    {
        Person::createNewPerson();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show()
    {
        $person = $this->personRepository->getOneById(request('id'));
        return view('person', ['person' => $person]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        return view('edit',
            [
                'person' => $this->personRepository->getOneById($id),
                'films' => $this->filmRepository->getAll(),
                'homeworlds' => $this->homeworldRepository->getAll(),
                'genders' => $this->genderRepository->getAll(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update()
    {

        $person = $this->personRepository->getOneById(request('id'));
        $person->updatePerson();
        $person->touch();

        return redirect('/people/' . $person->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy()
    {
        Person::deletePersonById(request('id'));
        return redirect()->route('home');
    }
}
