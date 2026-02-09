<?php

namespace App\Filament\Resources\LandingHeroes\Pages;

use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\LandingHeroes\LandingHeroResource;

class CreateLandingHero extends CreateRecord
{
    protected static string $resource = LandingHeroResource::class;
}
