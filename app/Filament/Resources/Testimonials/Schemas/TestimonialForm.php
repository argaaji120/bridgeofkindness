<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('category')
                    ->options([
                        'donor' => 'Donor',
                        'volunteer' => 'Volunteer',
                        'beneficiary' => 'Beneficiary',
                        'partner' => 'Partner',
                    ])
                    ->required()
                    ->native(false),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('testimonial-images')
                    ->columnSpanFull(),
                Radio::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published'
                    ])
                    ->descriptions([
                        'draft' => 'Is not visible.',
                        'published' => 'Is visible.'
                    ])
                    ->default('draft')
                    ->required(),
            ]);
    }
}
