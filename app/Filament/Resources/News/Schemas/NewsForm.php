<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Spatie\Tags\Tag;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->live(onBlur: true)
                    // ->afterStateUpdated(
                    //     fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    // )
                    ->required()
                    ->columnSpanFull(),
                // TextInput::make('slug')
                //     ->dehydrated()
                //     ->required(),
                FileUpload::make('featured_image')
                    ->image()
                    ->disk('public')
                    ->directory('news-images')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('news-images')
                    ->fileAttachmentsVisibility('public')
                    ->required()
                    ->columnSpanFull(),
                Select::make('categories')
                    ->label('Categories')
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived'
                    ])
                    ->default('draft')
                    ->native(false)
                    ->required(),
                SpatieTagsInput::make('tags')
                    ->suggestions(Tag::pluck('name')->toArray())
                    ->reorderable(),
                DatePicker::make('published_at')
                    ->label('Publish Date')
                    ->native(false)
                    ->required(),
            ]);
    }
}
