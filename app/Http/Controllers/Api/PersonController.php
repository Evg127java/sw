<?php

namespace App\Http\Controllers\Api;

use App\Entities\PersonEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonFormRequest;
use App\Http\Resources\PersonResource;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Services\PersonFilmsHandler;
use App\Services\PersonImagesHandler;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    private PersonRepositoryInterface $personRepository;

    /**
     * PersonController constructor.
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PersonResource::collection(
            $this->personRepository->getAll(config('app.peoplePerPageForAPI'))
        );
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
        $person = new PersonEntity($personFormRequest);
        $dataToInsert = array_intersect_key($personFormRequest, $person->toArray());
        $person = $this->personRepository->saveOne($dataToInsert);

        /* Process person's data to store */
        $request = (new PersonFilmsHandler($person, $personFormRequest))->run();
        $request = (new PersonImagesHandler($person, $request))->run();
        $dataToUpdate = array_intersect_key($request, $person->toArray());

        $person = $this->personRepository->updateOne($person, (array)$dataToUpdate);

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
     * @param PersonFormRequest $request
     * @return PersonResource
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
        return new PersonResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        PersonEntity::deletePersonById($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
