<?php

namespace App\Filament\Resources\Causes;

use App\Filament\Resources\Causes\Pages\CreateCause;
use App\Filament\Resources\Causes\Pages\EditCause;
use App\Filament\Resources\Causes\Pages\ListCauses;
use App\Filament\Resources\Causes\Schemas\CauseForm;
use App\Filament\Resources\Causes\Tables\CausesTable;
use App\Models\Cause;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CauseResource extends Resource
{
    protected static ?string $model = Cause::class;


    protected static ?string $recordTitleAttribute = 'Cause';

    public static function form(Schema $schema): Schema
    {
        return CauseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CausesTable::configure($table);
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
            'index' => ListCauses::route('/'),
            'create' => CreateCause::route('/create'),
            'edit' => EditCause::route('/{record}/edit'),
        ];
    }
}
