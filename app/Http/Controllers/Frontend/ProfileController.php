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
            ->with([
                'animal.category',
                'animal.images',
            ])
            ->get()
            ->pluck('animal')
            ->filter(); // penting supaya null dibuang

        return view('frontend.profile.index', compact(
            'user',
            'adoptions',
            'favorites'
        ));
    }

    // public function index()
    // {
    //     $user = Auth::user();

    //     $adoptions = AdoptionRequest::with('animal')
    //         ->where('user_id', $user->id)
    //         ->latest()
    //         ->get();

    //     $favorites = $user->favorites()
    //         ->with('animal')
    //         ->latest()
    //         ->get();

    //     return view('frontend.profile.index', compact(
    //         'user',
    //         'adoptions',
    //         'favorites'
    //     ));
    // }
}
