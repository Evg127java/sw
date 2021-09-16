<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonFormRequest;
use App\Models\Person;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\GenderRepository\GenderRepositoryInterface;
use App\Repositories\HomeworldRepository\HomeworldRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PersonController extends Controller
{
    protected PersonRepositoryInterface $personRepository;
    protected FilmRepositoryInterface $filmRepository;
    protected GenderRepositoryInterface $genderRepository;
    protected HomeworldRepositoryInterface $homeworldRepository;

    public function __construct(
        PersonRepositoryInterface $personRepositorySql,
        FilmRepositoryInterface $filmRepositorySql,
        GenderRepositoryInterface $genderRepositorySql,
        HomeworldRepositoryInterface $homeworldRepositorySql)
    {
        $this->personRepository = $personRepositorySql;
        $this->filmRepository = $filmRepositorySql;
        $this->genderRepository = $genderRepositorySql;
        $this->homeworldRepository = $homeworldRepositorySql;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $people = $this->personRepository
            ->getAllPeopleSorted('id', 'desc', ['films', 'gender', 'homeworld'], true);
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
     * @param PersonFormRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(PersonFormRequest $request)
    {
        $personFormRequest = $request->all();
        Person::createNewPerson($personFormRequest);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show()
    {
        $person = $this->personRepository->getPersonById(request('id'));
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
                'person' => $this->personRepository->getPersonById($id),
                'films' => $this->filmRepository->getAll(),
                'homeworlds' => $this->homeworldRepository->getAll(),
                'genders' => $this->genderRepository->getAll(),
            ]);
    }

    /**
     * Updates the specified resource in storage.
     *
     * @param PersonFormRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(PersonFormRequest $request)
    {
        $personFormRequest = $request->all();
        $person = $this->personRepository->getPersonById(request('id'));

        /* Update person's data */
        $person->updatePerson($personFormRequest);

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
        return redirect('/');
    }
}
