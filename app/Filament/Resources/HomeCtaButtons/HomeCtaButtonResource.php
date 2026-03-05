<?php

namespace App\Filament\Resources\HomeCtaButtons;

use App\Filament\Resources\HomeCtaButtons\Pages\CreateHomeCtaButton;
use App\Filament\Resources\HomeCtaButtons\Pages\EditHomeCtaButton;
use App\Filament\Resources\HomeCtaButtons\Pages\ListHomeCtaButtons;
use App\Filament\Resources\HomeCtaButtons\Schemas\HomeCtaButtonForm;
use App\Filament\Resources\HomeCtaButtons\Tables\HomeCtaButtonsTable;
use App\Models\HomeCtaButton;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeCtaButtonResource extends Resource
{
    protected static ?string $model = HomeCtaButton::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCursorArrowRipple;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::CursorArrowRipple;

    protected static ?string $recordTitleAttribute = 'HomeCtaButton';

    protected static ?string $navigationLabel = 'CTA Buttons';

    protected static ?string $modelLabel = 'CTA Button';

    public static function form(Schema $schema): Schema
    {
        return HomeCtaButtonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeCtaButtonsTable::configure($table);
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
            'index' => ListHomeCtaButtons::route('/'),
            'create' => CreateHomeCtaButton::route('/create'),
            'edit' => EditHomeCtaButton::route('/{record}/edit'),
        ];
    }
}
