<?php

namespace App\Filament\Resources\LandingHeroes;

use App\Filament\Resources\LandingHeroes\Pages\CreateLandingHero;
use App\Filament\Resources\LandingHeroes\Pages\EditLandingHero;
use App\Filament\Resources\LandingHeroes\Pages\ListLandingHeroes;
use App\Filament\Resources\LandingHeroes\Schemas\LandingHeroForm;
use App\Filament\Resources\LandingHeroes\Tables\LandingHeroesTable;
use App\Models\LandingHero;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use BackedEnum;

class LandingHeroResource extends Resource
{
    protected static ?string $model = LandingHero::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::Photo;

    protected static ?string $recordTitleAttribute = 'LandingHero';

    protected static ?string $navigationLabel = 'Hero Sections';

    protected static ?string $modelLabel = 'hero content';

    public static function form(Schema $schema): Schema
    {
        return LandingHeroForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LandingHeroesTable::configure($table);
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
            'index' => ListLandingHeroes::route('/'),
            'create' => CreateLandingHero::route('/create'),
            'edit' => EditLandingHero::route('/{record}/edit'),
        ];
    }
}
