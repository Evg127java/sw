<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeworldResource;
use App\Repositories\HomeworldRepository\HomeworldRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HomeworldController extends Controller
{
    private HomeworldRepositoryInterface $homeworldRepository;

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
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return HomeworldResource::collection($this->homeworldRepository->getAll());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return HomeworldResource
     */
    public function show($id)
    {
        $homeworld = $this->homeworldRepository->getOneById($id);
        return new HomeworldResource($homeworld);
    }
}
