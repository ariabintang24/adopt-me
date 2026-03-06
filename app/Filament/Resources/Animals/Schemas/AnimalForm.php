<?php

namespace App\Filament\Resources\Animals\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\{
    TextInput,
    Select,
    Textarea,
    Repeater,
    FileUpload,
    Hidden
};
use Filament\Schemas\Components\Grid;

class AnimalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),

                Select::make('age_range')
                    ->options([
                        '0-11' => '0 - 11 months',
                        '1-3'  => '1 - 3 years',
                        '3-5'  => '3 - 5 years',
                        '5+'   => '5+ years',
                    ])
                    ->required(),

                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),

                Textarea::make('description')
                    ->required(),

                Select::make('status')
                    ->options([
                        'available' => 'Available',
                        'adopted' => 'Adopted',
                    ])
                    ->default('available'),

                Repeater::make('images')
                    ->relationship()
                    ->schema([
                        FileUpload::make('image')
                            ->disk('public')
                            ->directory('animals')
                            ->image()
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->label('Animal Images')
                    ->addActionLabel('Add Image'),

            ]);
    }
}
