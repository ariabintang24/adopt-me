<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('name'),
            TextEntry::make('email'),
            TextEntry::make('phone')
                ->placeholder('— No phone —'),

            TextEntry::make('address')
                ->placeholder('— No address —'),
            TextEntry::make('avatar')
                ->placeholder('— No avatar —'),
            TextEntry::make('created_at')->dateTime(),
        ]);
    }
}
