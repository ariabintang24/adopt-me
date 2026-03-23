<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $animals = $user->animals()
            ->with(['images', 'category'])
            ->withCount([
                'favoritedBy as is_favorite' => function ($query) {
                    $query->where('user_id', auth()->id() ?? 0);
                }
            ])
            ->latest()
            ->take(6)
            ->get();

        $animalsCount = $user->animals()->count();

        return view('frontend.users.show', compact(
            'user',
            'animals',
            'animalsCount'
        ));
    }
}
