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
            TextEntry::make('has_experience')
                ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),
            // true → Yes
            // false → No
            TextEntry::make('residence_type'),
            TextEntry::make('other_pets')
                ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),
            // true → Yes
            // false → No

            TextEntry::make('other_pets_detail')
                ->placeholder('— No other pets —'),
            // TextEntry::make('other_pets_detail')
            //     ->visible(fn($record) => $record->other_pets === true)
            //     ->placeholder('— No detail provided —'),
            TextEntry::make('status'),
            TextEntry::make('admin_note')
                ->placeholder('No admin note'),
            TextEntry::make('created_at')->dateTime(),
        ]);
    }
}
