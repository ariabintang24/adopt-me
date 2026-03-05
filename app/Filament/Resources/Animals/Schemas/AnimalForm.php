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

                Grid::make(2)
                    ->schema([

                        TextInput::make('age_years')
                            ->label('Years')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->live(),

                        TextInput::make('age_months')
                            ->label('Months')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(11)
                            ->live(),

                    ])
                    ->afterStateHydrated(function ($set, $record) {

                        if (!$record || !$record->age_in_months) {
                            return;
                        }

                        $years = floor($record->age_in_months / 12);
                        $months = $record->age_in_months % 12;

                        $set('age_years', $years);
                        $set('age_months', $months);
                    }),

                Hidden::make('age_in_months')
                    ->dehydrateStateUsing(function ($get) {

                        $years = (int) $get('age_years');
                        $months = (int) $get('age_months');

                        return ($years * 12) + $months;
                    }),

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
