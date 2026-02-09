<?php

namespace App\Filament\Resources\LandingHeroes\Pages;

use App\Filament\Resources\LandingHeroes\LandingHeroResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLandingHero extends EditRecord
{
    protected static string $resource = LandingHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
