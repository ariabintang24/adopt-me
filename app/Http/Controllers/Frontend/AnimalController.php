<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $animals = Animal::query()
            ->with(['category', 'images'])
            ->where('status', 'available')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('frontend.animals.index', compact('animals'));
    }

    public function show(string $slug)
    {
        $animal = Animal::with(['category', 'images'])
            ->where('slug', $slug)
            ->where('status', 'available')
            ->firstOrFail();

        return view('frontend.animals.show', compact('animal'));
    }
}
