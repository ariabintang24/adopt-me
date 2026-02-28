<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{

    public function toggle(Animal $animal)
    {
        auth()->user()->favorites()->toggle($animal->id);

        return response()->json(['status' => 'success']);
    }

    // public function toggle(Animal $animal)
    // {
    //     $user = Auth::user();

    //     $favorite = $user->favorites()
    //         ->where('animal_id', $animal->id)
    //         ->first();

    //     if ($favorite) {
    //         $favorite->delete();

    //         return response()->json([
    //             'status' => 'removed'
    //         ]);
    //     }

    //     $user->favorites()->create([
    //         'animal_id' => $animal->id
    //     ]);

    //     return response()->json([
    //         'status' => 'added'
    //     ]);
    // }
}
