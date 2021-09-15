<?php

namespace App\Providers;

use App\Repositories\FilmRepository\FilmRepositoryInterface;
use App\Repositories\FilmRepository\FilmRepositorySql;
use App\Repositories\PersonRepository\PersonRepositoryInterface;
use App\Repositories\PersonRepository\PersonRepositorySql;
use App\Repositories\RepositoryInterface;
use App\Repositories\Repository;
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
        /* Repositories */
        $this->app->bind(
            RepositoryInterface::class,
            Repository::class
        );

        /* Service for images and films processing */
        $this->app->bind(
            PersonServiceInterface::class,
            PersonServices::class
        );

        $this->app->bind(
            PersonRepositoryInterface::class,
            PersonRepositorySql::class
        );
        $this->app->bind(
            FilmRepositoryInterface::class,
            FilmRepositorySql::class
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
