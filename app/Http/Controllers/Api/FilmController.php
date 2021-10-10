<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilmResource;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FilmController extends Controller
{
    private FilmRepositoryInterface $filmRepository;

    /**
     * FilmController constructor.
     * @param FilmRepositoryInterface $filmRepository
     */
    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return FilmResource::collection($this->filmRepository->getAll());

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return FilmResource
     */
    public function show($id)
    {
        $film = $this->filmRepository->getOneById($id);
        return new filmResource($film);
    }
}
