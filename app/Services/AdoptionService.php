<?php

namespace App\Services;

use App\Interfaces\AdoptionRepositoryInterface;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;

class AdoptionService
{
    protected $adoptionRepository;

    public function __construct(AdoptionRepositoryInterface $adoptionRepository)
    {
        $this->adoptionRepository = $adoptionRepository;
    }

    /*
    |--------------------------------------------------------------------------
    | Create Adoption Request
    |--------------------------------------------------------------------------
    */

    public function createAdoption(array $data)
    {
        // Cegah double request
        $exists = AdoptionRequest::where('user_id', $data['user_id'])
            ->where('animal_id', $data['animal_id'])
            ->exists();

        if ($exists) {
            throw new \Exception('You have already requested this animal.');
        }

        return $this->adoptionRepository->create($data);
    }

    /*
    |--------------------------------------------------------------------------
    | Approve Adoption (Transaction Safe)
    |--------------------------------------------------------------------------
    */

    public function approve(int $adoptionId, int $adminId)
    {
        DB::transaction(function () use ($adoptionId, $adminId) {

            $adoption = AdoptionRequest::lockForUpdate()
                ->findOrFail($adoptionId);

            if ($adoption->status !== 'pending') {
                throw new \Exception('This request has already been processed.');
            }

            $animal = Animal::lockForUpdate()
                ->findOrFail($adoption->animal_id);

            if ($animal->status === 'adopted') {
                throw new \Exception('Animal already adopted.');
            }

            // Update adoption request
            $adoption->update([
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => $adminId,
            ]);

            // Update animal status
            $animal->update([
                'status' => 'adopted'
            ]);

            // Optional: reject other pending requests
            AdoptionRequest::where('animal_id', $animal->id)
                ->where('status', 'pending')
                ->where('id', '!=', $adoption->id)
                ->update([
                    'status' => 'rejected',
                    'admin_note' => 'Another request has been approved.',
                ]);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Reject Adoption
    |--------------------------------------------------------------------------
    */

    public function reject(int $adoptionId, string $note = null)
    {
        $adoption = $this->adoptionRepository->findById($adoptionId);

        if ($adoption->status !== 'pending') {
            throw new \Exception('This request has already been processed.');
        }

        return $this->adoptionRepository->update($adoptionId, [
            'status' => 'rejected',
            'admin_note' => $note,
        ]);
    }
}
