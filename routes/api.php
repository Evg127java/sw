<?php

use App\Http\Controllers\Api\HomeworldController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'people' => PersonController::class,
    'homeworlds' => HomeworldController::class,
    'images' => ImageController::class,
]);
