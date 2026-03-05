<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use App\Services\AdoptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdoptionController extends Controller
{
    public function create(Animal $animal)
    {

        // 🚫 Tidak boleh adopt post sendiri
        if ($animal->created_by === auth()->id()) {
            return redirect()
                ->route('animals.show', $animal->slug)
                ->with('error', 'You cannot adopt your own animal post.');
        }

        // 🚫 Animal sudah adopted
        if ($animal->status !== 'available') {
            return redirect()
                ->route('animals.show', $animal->slug)
                ->with('error', 'This animal has already been adopted.');
        }

        $existing = auth()->user()
            ->adoptionRequests()
            ->where('animal_id', $animal->id)
            ->latest()
            ->first();

        if ($existing) {

            // ⏳ Jika pending
            if ($existing->status === 'pending') {
                return redirect()
                    ->route('animals.show', $animal->slug)
                    ->with('error', 'Your adoption request is currently under review.');
            }

            // ✅ Jika approved
            if ($existing->status === 'approved') {
                return redirect()
                    ->route('animals.show', $animal->slug)
                    ->with('error', 'Your adoption request has already been approved.');
            }

            // ❌ Jika rejected → boleh lanjut
        }

        return view('frontend.adoptions.create', compact('animal'));
    }

    public function store(Request $request, Animal $animal, AdoptionService $service)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:1000',
            'has_experience' => 'required|boolean',
            'residence_type' => 'required|string|max:255',
            'other_pets' => 'required|boolean',
            'other_pets_detail' => 'nullable|string|max:255',
        ]);

        try {

            $service->submit(
                auth()->id(),
                $animal->id,
                $validated
            );

            return redirect()
                ->route('profile.my-adoptions')
                ->with('success', 'Your adoption request has been submitted.');
        } catch (\Exception $e) {

            return redirect()
                ->route('animals.show', $animal->slug)
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function approve($id, AdoptionService $service)
    {
        try {
            $service->approve($id, auth()->id());

            return back()->with('success', 'Adoption approved successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject($id, Request $request, AdoptionService $service)
    {
        try {
            $service->reject($id, $request->admin_note);

            return back()->with('success', 'Adoption request rejected.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
