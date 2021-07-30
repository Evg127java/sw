<?php

use App\Http\Controllers\HomeworldController;
use App\Http\Controllers\PersonController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('verified')->group(function () {
    Route::post('/create', [PersonController::class, 'store']);

    Route::get('/create', [PersonController::class, 'create']);

    Route::get('/edit/{id}', [PersonController::class, 'edit'])->whereNumber('id');

    Route::put('/edit/{id}', [PersonController::class, 'update'])->whereNumber('id');

    Route::get('/delete/{id}', [PersonController::class, 'destroy'])->whereNumber('id');
});

Route::get('/', [PersonController::class, 'index']);

Route::get('/people/{id}', [PersonController::class, 'show'])->whereNumber('id');

Route::post('/create', [PersonController::class, 'store']);

Route::get('/homeworld', [HomeworldController::class, 'index']);

Route::get('/homeworld/{homeworld:name}', [HomeworldController::class, 'show'])->whereAlpha('homeworld:name');

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
