<?php

namespace App\Providers;

use App\Interfaces\AdoptionRepositoryInterface;
use App\Interfaces\AnimalRepositoryInterface;
use App\Repositories\AdoptionRepository;
use App\Repositories\AnimalRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AnimalRepositoryInterface::class,
            AnimalRepository::class
        );
        $this->app->bind(
            AdoptionRepositoryInterface::class,
            AdoptionRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
    }
}
