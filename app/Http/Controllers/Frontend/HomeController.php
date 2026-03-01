<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $latestAnimals = Animal::with(['category', 'images'])
            ->where('status', 'available')
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.home.index', compact('categories', 'latestAnimals'));
    }
}
