<?php

namespace App\Filament\Resources\LandingHeroes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class LandingHeroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->disk('public')
                    ->directory('hero-images')
                    ->label('Image')
                    ->image()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
