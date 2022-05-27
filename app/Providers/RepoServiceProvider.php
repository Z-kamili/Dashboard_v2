<?php

namespace App\Providers;

use App\Interfaces\CrudRepositoryInterface;
use App\Repository\CrudRepository;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    { 
        $this->app->bind(CrudRepositoryInterface::class,CrudRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
