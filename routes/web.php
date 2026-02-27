<?php

use App\Http\Controllers\Frontend\AdoptionController;
use App\Http\Controllers\Frontend\AnimalController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/animals', [AnimalController::class, 'index']);
Route::get('/animals/{slug}', [AnimalController::class, 'show']);

Route::middleware('auth')->group(function () {

    Route::get('/adoption/create/{animal}', [AdoptionController::class, 'create']);
    Route::post('/adoption/{animal}', [AdoptionController::class, 'store']);

    Route::post('/favorite/{animal}', [FavoriteController::class, 'toggle']);

    Route::get('/profile', [ProfileController::class, 'index']);
});

require __DIR__ . '/auth.php';
