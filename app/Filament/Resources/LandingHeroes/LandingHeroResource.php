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
use UnitEnum;

class LandingHeroResource extends Resource
{
    protected static ?string $model = LandingHero::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'LandingHero';

    protected static ?string $navigationLabel = 'Hero Sections';

    protected static ?string $modelLabel = 'hero content';

    protected static string | UnitEnum | null $navigationGroup = 'Landing Page Management';

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
