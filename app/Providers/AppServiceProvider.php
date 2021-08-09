<?php

namespace App\Providers;

use App\Repository\RepositoryInterface;
use App\Repository\Repository;
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
