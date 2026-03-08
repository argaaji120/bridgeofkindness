<?php

namespace App\Filament\Resources\Causes\Schemas;

use App\Models\Cause;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Illuminate\Support\Str;

use function Symfony\Component\Clock\now;

class CauseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->disk('public')
                    ->directory('cause-images')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    )
                    ->required(),
                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->unique(Cause::class, 'slug', ignoreRecord: true),
                Textarea::make('description')
                    ->required()
                    ->autosize()
                    ->columnSpanFull(),
                TextInput::make('sort_description')
                    ->label('Sort Description')
                    ->required(),
                TextInput::make('goal_amount')
                    ->label('Goal Amount')
                    ->numeric()
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->required(),
                Select::make('category')
                    ->options([
                        'education' => 'Education',
                        'health' => 'Health',
                        'environment' => 'Environment',
                        'poverty' => 'Poverty',
                        'disaster_relief' => 'Disaster Relief',
                        'community' => 'Community',
                        'other' => 'Other',
                    ])
                    ->native(false)
                    ->required(),
                Select::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'active'    => 'In Progress',
                        'paused'    => 'On Hold',
                        'completed' => 'Finished',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('draft')
                    ->native(false)
                    ->required(),
                DatePicker::make('start_date')
                    ->native(false)
                    ->format('Y-m-d')
                    ->closeOnDateSelection(),
                DatePicker::make('end_date')
                    ->native(false)
                    ->format('Y-m-d')
                    ->closeOnDateSelection(),
                Toggle::make('featured')
                    ->inline(false)
                    ->required(),
            ]);
    }
}
