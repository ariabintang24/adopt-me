<?php

namespace App\Repositories;

use App\Models\AdoptRequest;
use App\Interfaces\AdoptionRepositoryInterface;

class AdoptionRepository implements AdoptionRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $query = AdoptRequest::with(['user', 'animal']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->paginate(10);
    }

    public function findById(int $id)
    {
        return AdoptRequest::with(['user', 'animal'])
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return AdoptRequest::create($data);
    }

    public function update(int $id, array $data)
    {
        $adoption = AdoptRequest::findOrFail($id);
        $adoption->update($data);

        return $adoption;
    }
}
