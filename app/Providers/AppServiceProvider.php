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
        $this->app->bind(
            RepositoryInterface::class,
            Repository::class
        );

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
        Paginator::useBootstrap();
    }
}
