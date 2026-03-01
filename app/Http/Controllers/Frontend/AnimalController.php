<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $animals = Animal::query()
            ->with(['category', 'images'])
            ->withCount([
                'favoritedBy as is_favorite' => function ($query) {
                    if (auth()->check()) {
                        $query->where('user_id', auth()->id());
                    }
                }
            ])
            ->where('status', 'available')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($cat) use ($search) {
                            $cat->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('frontend.animals.index', compact('animals', 'search'));
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
