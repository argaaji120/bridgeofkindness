<?php

namespace App\Filament\Resources\HomeCtaButtons\Pages;

use App\Filament\Resources\HomeCtaButtons\HomeCtaButtonResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeCtaButton extends EditRecord
{
    protected static string $resource = HomeCtaButtonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
