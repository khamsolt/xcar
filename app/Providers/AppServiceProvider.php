<?php

namespace App\Providers;

use App\Services\Brand\CrudService as BrandCrudService;
use App\Services\Brand\Crudable as BrandCrudInterface;
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
        $this->app->singleton(BrandCrudInterface::class, BrandCrudService::class);
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
