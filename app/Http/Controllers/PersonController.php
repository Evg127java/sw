<?php

namespace App\Http\Controllers;

use App\Entities\PersonEntity;
use App\Http\Requests\PersonFormRequest;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\GenderRepository\GenderRepositoryInterface;
use App\Repositories\HomeworldRepository\HomeworldRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Services\PersonFilmsHandler;
use App\Services\PersonImagesHandler;
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
        $people = $this->personRepository->getAllSorted(
            'id',
            'desc',
            [],
            config('app.peoplePerPageAtAll')
        );
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
        $person = new PersonEntity($personFormRequest);
        $dataToInsert = array_intersect_key($personFormRequest, $person->toArray());
        $person = $this->personRepository->saveOne($dataToInsert);

        /* Process person's data to store */
        $request = (new PersonFilmsHandler($person, $personFormRequest))->run();
        $request = (new PersonImagesHandler($person, $request))->run();
        $dataToUpdate = array_intersect_key($request, $person->toArray());

        $this->personRepository->updateOne($person, (array)$dataToUpdate);

        return redirect('/');
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
     * Updates the specified resource in storage.
     *
     * @param PersonFormRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(PersonFormRequest $request)
    {
        $personFormRequest = $request->all();
        $person = $this->personRepository->getOneById(request('id'));

        /* Process person's data to update */
        $request = (new PersonFilmsHandler($person, $personFormRequest))->run();
        $request = (new PersonImagesHandler($person, $request))->run();
        $dataToUpdate = array_intersect_key($request, $person->toArray());

        $person = $this->personRepository->updateOne($person, (array)$dataToUpdate);
        return redirect('/people/' . $person->getId());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy()
    {
        PersonEntity::deletePersonById(request('id'));
        return redirect('/');
    }
}
