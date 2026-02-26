<?php

namespace App\Filament\Resources\Adoptions;

use App\Filament\Resources\Adoptions\Pages\CreateAdoption;
use App\Filament\Resources\Adoptions\Pages\EditAdoption;
use App\Filament\Resources\Adoptions\Pages\ListAdoptions;
use App\Filament\Resources\Adoptions\Pages\ViewAdoption;
use App\Filament\Resources\Adoptions\Schemas\AdoptionForm;
use App\Filament\Resources\Adoptions\Schemas\AdoptionInfolist;
use App\Filament\Resources\Adoptions\Tables\AdoptionsTable;
use App\Models\AdoptRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdoptionResource extends Resource
{
    protected static ?string $model = AdoptRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return AdoptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AdoptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdoptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdoptions::route('/'),
            'create' => CreateAdoption::route('/create'),
            'view' => ViewAdoption::route('/{record}'),
            'edit' => EditAdoption::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
