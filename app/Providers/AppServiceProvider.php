<?php

namespace App\Providers;

use App\Services\Brand\Crudable as BrandCrudInterface;
use App\Services\Brand\CrudService as BrandCrudService;
use App\Services\Car\Crudable as CarCrudInterface;
use App\Services\Car\CrudService as CarCrudService;
use App\Services\Media\Contract as MediaManager;
use App\Services\Media\ManagerService;
use App\Services\Model\Crudable as ModelCrudInterface;
use App\Services\Model\CrudService as ModelCrudService;
use App\View\Components\Input\Select;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        $this->app->singleton(ModelCrudInterface::class, ModelCrudService::class);
        $this->app->singleton(CarCrudInterface::class, CarCrudService::class);
        $this->app->singleton(MediaManager::class, ManagerService::class);
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('input-select', Select::class);
    }
}
