<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $pendingCount = $user->adoptions()->where('status', 'pending')->count();

        $approvedCount = $user->adoptions()->where('status', 'approved')->count();

        $rejectedCount = $user->adoptions()
            ->whereIn('status', ['rejected', 'auto_rejected'])
            ->count();

        $adoptions = $user->adoptionRequests()
            ->with('animal.images')
            ->latest()
            ->take(3) //menampilkan preview
            ->get();

        $favorites = $user->favorites()
            ->with(['category', 'images'])
            ->latest()
            ->take(3) //menampilkan preview
            ->get();

        return view('frontend.profile.index', compact(
            'user',
            'adoptions',
            'favorites',
            'pendingCount',
            'approvedCount',
            'rejectedCount'
        ));
    }

    public function myAdoptions()
    {
        $user = auth()->user();

        $adoptions = $user->adoptions()
            ->with(['animal.images'])
            ->latest()
            ->paginate(5);

        return view('frontend.profile.history', compact('user', 'adoptions'));
    }

    public function myFavorites()
    {
        $user = auth()->user();

        $favorites = $user->favorites()
            ->with(['images'])
            ->latest()
            ->paginate(6);

        return view('frontend.profile.favorites', compact('user', 'favorites'));
    }

    public function myPosts()
    {
        $animals = Animal::where('created_by', auth()->id())
            ->latest()
            ->paginate(6);

        return view('frontend.profile.my-posts', compact('animals'));
    }
}
