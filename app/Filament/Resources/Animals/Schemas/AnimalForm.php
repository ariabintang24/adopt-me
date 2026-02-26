<?php

namespace App\Filament\Resources\Animals\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\{
    TextInput,
    Select,
    Textarea,
    Repeater,
    FileUpload
};

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

                TextInput::make('age')
                    ->numeric()
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
                            ->image()
                            ->directory('animals')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->label('Animal Images')
                    ->addActionLabel('Add Image'),

            ]);
    }
}
