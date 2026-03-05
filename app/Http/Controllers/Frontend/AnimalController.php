<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Category;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort;
        $category = $request->category;
        $gender = $request->gender;
        $age = $request->age;

        $animals = Animal::query()
            ->with(['category', 'images'])
            ->withCount([
                'favoritedBy as is_favorite' => function ($query) {
                    if (auth()->check()) {
                        $query->where('user_id', auth()->id());
                    }
                }
            ])
            ->where('status', 'available');

        // 🔎 SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $animals->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($cat) use ($search) {
                        $cat->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // 🐾 CATEGORY
        if ($request->filled('category')) {
            $animals->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 🚻 GENDER
        if ($request->filled('gender')) {
            $animals->where('gender', $request->gender);
        }

        // 🎂 AGE
        if ($request->filled('age')) {

            if ($request->age === '0-11') {
                $animals->whereBetween('age_in_months', [0, 11]);
            } elseif ($request->age === '1-2') {
                $animals->whereBetween('age_in_months', [12, 24]);
            } elseif ($request->age === '2+') {
                $animals->where('age_in_months', '>', 24);
            }
        }

        // 🔄 SORT
        if ($request->sort === 'oldest') {
            $animals->oldest();
        } else {
            $animals->latest();
        }

        $animals = $animals->paginate(6)->withQueryString();

        $categories = Category::all();

        return view('frontend.animals.index', compact('animals', 'categories'));
    }

    public function show(string $slug)
    {
        $animal = Animal::with(['category', 'images'])
            ->where('slug', $slug)
            // ->where('status', 'available')
            ->firstOrFail();

        $userRequest = null;

        if (auth()->check()) {
            $userRequest = auth()->user()
                ->adoptionRequests()
                ->where('animal_id', $animal->id)
                ->latest()
                ->first();
        }

        return view('frontend.animals.show', compact('animal', 'userRequest'));
    }
}
