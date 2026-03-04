<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\AdoptionController;
use App\Http\Controllers\Frontend\AnimalController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [ContactController::class, 'send'])
    ->name('contact.send');

Route::prefix('animals')->name('animals.')->group(function () {

    Route::get('/', [AnimalController::class, 'index'])
        ->name('index');

    Route::get('/{slug}', [AnimalController::class, 'show'])
        ->name('show');
});

Route::middleware('auth')->group(function () {

    //Adoption 
    Route::prefix('adoption')->name('adoption.')->group(function () {

        Route::get('/create/{animal}', [AdoptionController::class, 'create'])
            ->name('create');

        Route::post('/{animal}', [AdoptionController::class, 'store'])
            ->name('store');
    });

    //Favorite 
    Route::prefix('favorite')->name('favorite.')->group(function () {

        Route::post('/{animal}', [FavoriteController::class, 'toggle'])
            ->name('toggle');
    });

    //Profile 
    Route::prefix('profile')->name('profile.')->group(function () {

        Route::get('/', [ProfileController::class, 'index'])->name('index');

        Route::get('/my-adoptions', [ProfileController::class, 'myAdoptions'])
            ->name('my-adoptions');

        Route::get('/my-favorites', [ProfileController::class, 'myFavorites'])
            ->name('my-favorites');
    });
});

require __DIR__ . '/auth.php';
