<?php

namespace App\Filament\Resources\HomeCtaButtons\Pages;

use App\Filament\Resources\HomeCtaButtons\HomeCtaButtonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeCtaButtons extends ListRecords
{
    protected static string $resource = HomeCtaButtonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
