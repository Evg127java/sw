<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ImageResource::collection(Image::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ImageResource
     */
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return new ImageResource($image);
    }
}

