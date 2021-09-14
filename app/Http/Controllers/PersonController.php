<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonFormRequest;
use App\Models\Film;
use App\Models\Gender;
use App\Models\Homeworld;
use App\Models\Person;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Services\PersonServiceInterface;
use App\Services\PersonServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PersonController extends Controller
{
    protected PersonServiceInterface $personServices;
    protected PersonRepositoryInterface $personRepository;

    public function __construct(
        PersonServiceInterface $personServices,
        RepositoryInterface $repository,
        Film $film, Gender $gender, Homeworld $homeworld, PersonRepositoryInterface $personRepositorySql)
    {
        parent::__construct($repository, $film, $gender, $homeworld);
        $this->personServices = $personServices;
        $this->personRepository = $personRepositorySql;
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
        $person = Person::createNewPerson($personFormRequest);

        /* Process person's external relations */
        $this->personServices
            ->setPerson($person)
            ->setRequest($personFormRequest)
            ->processPersonRelations();

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

        /* Update person's base data */
        $person = $person->updatePerson($personFormRequest);

        /* Process person's external relations */
        $this->personServices
            ->setPerson($person)
            ->setRequest($personFormRequest)
            ->processPersonRelations();

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
