<?php

namespace App\Filament\Resources\Adoptions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AdoptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('user.name')->label('User'),
            TextEntry::make('animal.name')->label('Animal'),
            TextEntry::make('reason'),
            TextEntry::make('has_experience'),
            TextEntry::make('residence_type'),
            TextEntry::make('other_pets'),
            TextEntry::make('status'),
            TextEntry::make('admin_note'),
            TextEntry::make('created_at')->dateTime(),
        ]);
    }
}
