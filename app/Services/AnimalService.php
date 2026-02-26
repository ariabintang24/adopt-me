<?php

namespace App\Services;

use App\Interfaces\AnimalRepositoryInterface;
use App\Models\Animal;
use Illuminate\Support\Str;

class AnimalService
{
    protected $animalRepository;

    public function __construct(AnimalRepositoryInterface $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }

    /*
    Public Methods
    */

    public function getAnimals(array $filters = [])
    {
        return $this->animalRepository->getAll($filters);
    }

    public function getAnimalById(int $id)
    {
        return $this->animalRepository->findById($id);
    }

    public function getAnimalBySlug(string $slug)
    {
        return $this->animalRepository->findBySlug($slug);
    }

    public function createAnimal(array $data)
    {
        $data['code'] = $this->generateAnimalCode();
        $data['slug'] = $this->generateSlug($data['name']);

        return $this->animalRepository->create($data);
    }

    public function updateAnimal(int $id, array $data)
    {
        if (isset($data['name'])) {
            $data['slug'] = $this->generateSlug($data['name'], $id);
        }

        return $this->animalRepository->update($id, $data);
    }

    public function deleteAnimal(int $id)
    {
        return $this->animalRepository->delete($id);
    }

    /*
    Private Helpers
    */

    private function generateAnimalCode(): string
    {
        $latest = Animal::latest('id')->first();

        $nextId = $latest ? $latest->id + 1 : 1;

        return 'ANM-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    private function generateSlug(string $name, $ignoreId = null): string
    {
        $slug = Str::slug($name);

        $query = Animal::where('slug', 'LIKE', "{$slug}%");

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $count = $query->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
