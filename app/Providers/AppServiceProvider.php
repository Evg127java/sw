<?php

namespace App\Providers;

use App\Models\Starship;
use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\FilmRepository\FilmRepositorySql;
use App\Repositories\GenderRepository\GenderRepositoryInterface;
use App\Repositories\GenderRepository\GenderRepositorySql;
use App\Repositories\HomeworldRepository\HomeworldRepositoryInterface;
use App\Repositories\HomeworldRepository\HomeworldRepositorySql;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositorySql;
use App\Repositories\SpecieRepository\SpecieRepositoryInterface;
use App\Repositories\SpecieRepository\SpecieRepositorySql;
use App\Repositories\StarshipRepository\StarshipRepositoryInterface;
use App\Repositories\StarshipRepository\StarshipRepositorySql;
use App\Repositories\VehicleRepository\VehicleRepositoryInterface;
use App\Repositories\VehicleRepository\VehicleRepositorySql;
use App\Services\PersonServiceInterface;
use App\Services\PersonServices;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /* Service for images and films processing */
        $this->app->bind(
            PersonServiceInterface::class,
            PersonServices::class
        );


        /* Repositories */

        $this->app->bind(
            PersonRepositoryInterface::class,
            PersonRepositorySql::class
        );
        $this->app->bind(
            FilmRepositoryInterface::class,
            FilmRepositorySql::class
        );
        $this->app->bind(
            GenderRepositoryInterface::class,
            GenderRepositorySql::class
        );
        $this->app->bind(
            HomeworldRepositoryInterface::class,
            HomeworldRepositorySql::class
        );
        $this->app->bind(
            StarshipRepositoryInterface::class,
            StarshipRepositorySql::class
        );
        $this->app->bind(
            VehicleRepositoryInterface::class,
            VehicleRepositorySql::class
        );
        $this->app->bind(
            SpecieRepositoryInterface::class,
            SpecieRepositorySql::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Use bootstrap paginator */
        Paginator::useBootstrap();
    }
}
