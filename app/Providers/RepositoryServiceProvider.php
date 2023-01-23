<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CurrencyRepository;
use App\Interfaces\CurrencyInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //binding Interface and repository
        $this->app->bind(CurrencyInterface::class, CurrencyRepository::class);

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
