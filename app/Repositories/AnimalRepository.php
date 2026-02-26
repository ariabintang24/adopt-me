<?php

namespace App\Repositories;

use App\Models\Animal;
use App\Interfaces\AnimalRepositoryInterface;

class AnimalRepository implements AnimalRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $query = Animal::with(['category', 'images']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->latest()->paginate(9);
    }

    public function findById(int $id)
    {
        return Animal::with(['category', 'images'])->findOrFail($id);
    }

    public function findBySlug(string $slug)
    {
        return Animal::with(['category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return Animal::create($data);
    }

    public function update(int $id, array $data)
    {
        $animal = Animal::findOrFail($id);
        $animal->update($data);

        return $animal;
    }

    public function delete(int $id)
    {
        $animal = Animal::findOrFail($id);
        return $animal->delete();
    }
}
