<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdoptionRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $adoptions = $user->adoptionRequests()
            ->with('animal.images')
            ->latest()
            ->get();

        $favorites = $user->favorites()
            ->with(['category', 'images'])
            ->latest()
            ->get();

        return view('frontend.profile.index', compact(
            'user',
            'adoptions',
            'favorites'
        ));
    }

    public function myAdoptions()
    {
        $user = auth()->user();

        $adoptions = $user->adoptions()
            ->with(['animal.images'])
            ->latest()
            ->get();

        return view('frontend.profile.history', compact('user', 'adoptions'));
    }

    public function myFavorites()
    {
        $user = auth()->user();

        $favorites = $user->favorites()
            ->with(['images'])
            ->latest()
            ->get();

        return view('frontend.profile.favorites', compact('user', 'favorites'));
    }
}
