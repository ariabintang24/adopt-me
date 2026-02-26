<?php

namespace App\Providers;

use App\Interfaces\AnimalRepositoryInterface;
use App\Repositories\AnimalRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
