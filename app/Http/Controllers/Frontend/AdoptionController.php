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
        try {
            $service->submit(
                auth()->id(),
                $animal->id,
                $request->only([
                    'reason',
                    'has_experience',
                    'residence_type',
                    'other_pets',
                    'other_pets_detail'
                ])
            );

            return redirect()
                ->route('profile')
                ->with('success', 'Your adoption request has been submitted.');
        } catch (\Exception $e) {

            return redirect()
                ->route('animals.show', $animal->slug)
                ->with('error', $e->getMessage());
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
