<?php

namespace App\Filament\Resources\LandingHeroes\Pages;

use App\Filament\Resources\LandingHeroes\LandingHeroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLandingHeroes extends ListRecords
{
    protected static string $resource = LandingHeroResource::class;

    protected static ?string $title = 'Hero Sections';


    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
