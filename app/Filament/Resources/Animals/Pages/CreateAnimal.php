<?php

namespace App\Filament\Resources\Animals\Pages;

use App\Filament\Resources\Animals\AnimalResource;
use App\Services\AnimalService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(AnimalService::class)->createAnimal($data);
    }
}
