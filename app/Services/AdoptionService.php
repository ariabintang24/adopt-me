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

    // public function createAdoption(array $data)
    // {
    //     // Cegah double request
    //     $exists = AdoptionRequest::where('user_id', $data['user_id'])
    //         ->where('animal_id', $data['animal_id'])
    //         ->exists();

    //     if ($exists) {
    //         throw new \Exception('You have already requested this animal.');
    //     }

    //     return $this->adoptionRepository->create($data);
    // }

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
                    'status' => AdoptionRequest::STATUS_AUTO_REJECTED,
                    'admin_note' => AdoptionRequest::AUTO_REJECT_NOTE,
                ]);
        });
    }

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

    public function submit(int $userId, int $animalId, array $data)
    {
        return DB::transaction(function () use ($userId, $animalId, $data) {

            $animal = Animal::lockForUpdate()->findOrFail($animalId);

            // 🚫 Tidak boleh adopt post sendiri
            if ($animal->created_by === $userId) {
                throw new \Exception('You cannot adopt your own animal post.');
            }


            if ($animal->status === 'adopted') {
                throw new \Exception('This animal has already been adopted.');
            }

            $activeRequest = $this->adoptionRepository
                ->findActiveByUserAndAnimal($userId, $animalId);

            if ($activeRequest) {
                throw new \Exception('You already have an active adoption request for this animal.');
            }

            return $this->adoptionRepository->create([
                'user_id' => $userId,
                'animal_id' => $animalId,
                ...$data,
                'status' => 'pending',
            ]);
        });


        // $existing = AdoptionRequest::where('user_id', $userId)
        //     ->where('animal_id', $animalId)
        //     ->first();

        // // 🚫 Jika masih pending atau approved
        // if ($existing && in_array($existing->status, ['pending', 'approved'])) {
        //     throw new \Exception('You already have an active adoption request for this animal.');
        // }

        // // 🔁 Jika rejected → update & kirim ulang
        // if ($existing && $existing->status === 'rejected') {
        //     $existing->update([
        //         'reason' => $data['reason'],
        //         'has_experience' => $data['has_experience'],
        //         'residence_type' => $data['residence_type'],
        //         'other_pets' => $data['other_pets'],
        //         'other_pets_detail' => $data['other_pets_detail'] ?? null,
        //         'status' => 'pending',
        //     ]);

        //     return $existing;
        // }

        // // 🆕 Jika belum pernah apply
        // return AdoptionRequest::create([
        //     'user_id' => $userId,
        //     'animal_id' => $animalId,
        //     'reason' => $data['reason'],
        //     'has_experience' => $data['has_experience'],
        //     'residence_type' => $data['residence_type'],
        //     'other_pets' => $data['other_pets'],
        //     'other_pets_detail' => $data['other_pets_detail'] ?? null,
        //     'status' => 'pending',
        // ]);

    }
}
