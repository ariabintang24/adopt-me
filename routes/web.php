<?php

use App\Http\Controllers\Frontend\AdoptionController;
use App\Http\Controllers\Frontend\AnimalController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animals/{slug}', [AnimalController::class, 'show'])->name('animals.show');

Route::middleware('auth')->group(function () {

    Route::get(
        '/adoption/create/{animal}',
        [AdoptionController::class, 'create']
    )->name('adoption.create');

    Route::post(
        '/adoption/{animal}',
        [AdoptionController::class, 'store']
    )->name('adoption.store');

    Route::post(
        '/favorite/{animal}',
        [FavoriteController::class, 'toggle']
    )->name('favorite.toggle');

    Route::get(
        '/profile',
        [ProfileController::class, 'index']
    )->name('profile');
});

require __DIR__ . '/auth.php';
