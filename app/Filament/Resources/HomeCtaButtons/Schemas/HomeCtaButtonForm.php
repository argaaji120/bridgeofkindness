<?php

namespace App\Filament\Resources\HomeCtaButtons\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HomeCtaButtonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title_prefix')
                    ->label('Prefix'),
                TextInput::make('title_highlight')
                    ->label('Highlight'),
                TextInput::make('title_suffix')
                    ->label('Suffix'),
                TextInput::make('link')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('cta-images')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }
}
