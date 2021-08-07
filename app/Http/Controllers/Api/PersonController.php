<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonFormRequest;
use App\Http\Resources\PersonResource;
use App\Models\Film;
use App\Models\Gender;
use App\Models\Homeworld;
use App\Models\Person;
use App\Repository\RepositoryInterface;
use App\Services\PersonServiceInterface;
use App\Services\PersonServices;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    protected PersonServiceInterface $personServices;

    public function __construct(
        RepositoryInterface $repository,
        PersonServiceInterface $personServices,
        Person $person,
        Film $film, Gender $gender, Homeworld $homeworld)
    {
        parent::__construct($repository, $person, $film, $gender, $homeworld);
        $this->personServices = $personServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PersonResource::collection($this->personRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PersonFormRequest $request
     * @return PersonResource
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

        return new PersonResource($person);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PersonResource
     */
    public function show($id)
    {
        $person = $this->personRepository->getOneById($id);
        return new PersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return PersonResource
     */
    public function update(PersonFormRequest $request, $id)
    {
        $personFormRequest = $request->all();
        $person = $this->personRepository->getOneById($id);

        /* Update person's base data */
        $person = $person->updatePerson($personFormRequest);

        /* Process person's external relations */
        $this->personServices
            ->setPerson($person)
            ->setRequest($personFormRequest)
            ->processPersonRelations();

        return new PersonResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Person::deletePersonById($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
