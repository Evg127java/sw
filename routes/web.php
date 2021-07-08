<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PersonController::class, 'index'])->name('home');

Route::get('/people/{id}', [PersonController::class, 'show'])->whereNumber('id');

Route::post('/create', [PersonController::class, 'store']);

Route::get('/create', [PersonController::class, 'create']);

Route::get('/edit/{id}', [PersonController::class, 'edit'])->whereNumber('id');

Route::post('/edit/{id}', [PersonController::class, 'update'])->whereNumber('id');

Route::get('/delete/{id}', [PersonController::class, 'destroy'])->whereNumber('id');
