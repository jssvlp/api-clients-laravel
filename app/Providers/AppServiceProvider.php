<?php

namespace App\Providers;

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
            'App\Repositories\Interfaces\IClientRepository',
            'App\Repositories\ClientRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\IProfileRepository',
            'App\Repositories\ProfileRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\IAddressRepository',
            'App\Repositories\AddressRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
