<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Services\AdoptionService;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function create(Animal $animal)
    {
        if ($animal->status !== 'available') {
            abort(404, 'Animal not available for adoption.');
        }

        return view('frontend.adoption.create', compact('animal'));
    }

    public function store(Request $request, Animal $animal, AdoptionService $adoptionService)
    {
        $request->validate([
            'reason' => 'required|string|min:10',
            'has_experience' => 'required|boolean',
            'residence_type' => 'required|string|max:255',
            'other_pets' => 'required|boolean',
            'other_pets_detail' => 'nullable|string|max:255',
        ]);

        $adoptionService->submit(
            auth()->id(),
            $animal->id,
            $request->all()
        );

        return redirect()->route('profile')
            ->with('success', 'Adoption request submitted successfully.');
    }
}
