<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\BlogRepository;
use App\Repository\Interfaces\BlogRepositoryInterface;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );
    }


}
