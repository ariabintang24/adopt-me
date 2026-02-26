<?php

namespace App\Filament\Resources\Adoptions\Pages;

use App\Filament\Resources\Adoptions\AdoptionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAdoption extends ViewRecord
{
    protected static string $resource = AdoptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
