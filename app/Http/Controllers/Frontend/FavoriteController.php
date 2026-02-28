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
        $user = auth()->user();

        $favorite = \App\Models\Favorite::where('user_id', $user->id)
            ->where('animal_id', $animal->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        }

        try {
            \App\Models\Favorite::create([
                'user_id' => $user->id,
                'animal_id' => $animal->id,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // jika duplicate karena race condition, anggap sudah ada
            return response()->json(['status' => 'added']);
        }

        return response()->json(['status' => 'added']);
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
