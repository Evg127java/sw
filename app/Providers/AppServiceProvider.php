<?php

namespace App\Providers;

use App\Repositories\FilmRepository;
use App\Repositories\GenderRepository;
use App\Repositories\HomeworldRepository;
use App\Repositories\Interfaces\FilmRepositoryInterface;
use App\Repositories\Interfaces\GenderRepositoryInterface;
use App\Repositories\Interfaces\HomeworldRepositoryInterface;
use App\Repositories\Interfaces\PersonRepositoryInterface;
use App\Repositories\PersonRepository;
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
        $this->app->bind(
            PersonRepositoryInterface::class,
            PersonRepository::class,
        );
        $this->app->bind(
            FilmRepositoryInterface::class,
            FilmRepository::class,
        );
        $this->app->bind(
            GenderRepositoryInterface::class,
            GenderRepository::class,
        );
        $this->app->bind(
            HomeworldRepositoryInterface::class,
            HomeworldRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
