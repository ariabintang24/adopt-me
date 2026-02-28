<?php

namespace App\Repositories;

use App\Models\AdoptionRequest;
use App\Interfaces\AdoptionRepositoryInterface;

class AdoptionRepository implements AdoptionRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $query = AdoptionRequest::with(['user', 'animal']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->paginate(10);
    }

    public function findById(int $id)
    {
        return AdoptionRequest::with(['user', 'animal'])
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return AdoptionRequest::create($data);
    }

    public function update(int $id, array $data)
    {
        $adoption = AdoptionRequest::findOrFail($id);
        $adoption->update($data);

        return $adoption;
    }

    public function findActiveByUserAndAnimal(int $userId, int $animalId)
    {
        return AdoptionRequest::where('user_id', $userId)
            ->where('animal_id', $animalId)
            ->whereIn('status', ['pending', 'approved'])
            ->first();
    }
}
