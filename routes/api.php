<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FilmController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/name', function (Request $request) {
    return $request->user()->name;
});

/* Public routes */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/people', [PersonController::class, 'index']);
Route::get('/people/{id}', [PersonController::class, 'show']);

Route::apiResources([
    'homeworlds' => HomeworldController::class,
    'images' => ImageController::class,
    'films' => FilmController::class,
]);

/* Protected routes */
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/people', [PersonController::class, 'store']);
    Route::put('/people/{id}', [PersonController::class, 'update']);
    Route::delete('/people/{id}', [PersonController::class, 'destroy']);
});
