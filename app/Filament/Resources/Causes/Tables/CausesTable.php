<?php

namespace App\Filament\Resources\Causes\Tables;

use App\Models\Cause;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CausesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Cause $record): string => Str::limit($record->sort_description, 50))
                    ->tooltip(
                        fn(Cause $record): ?string =>
                        Str::limit($record->sort_description) > 50
                            ? $record->sort_description
                            : null
                    ),

                TextColumn::make('goal_amount')
                    ->label('Goal')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('raised_amount')
                    ->label('Raised')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('category')
                    ->badge()
                    ->sortable()
                    ->color(fn(string $state): string => match ($state) {
                        'education'       => 'info',     // blue
                        'health'          => 'success',  // green
                        'environment'     => 'warning',  // yellow
                        'poverty'         => 'danger',   // red
                        'disaster_relief' => 'gray',     // neutral
                        'community'       => 'primary',  // purple
                        'other'           => 'secondary', // light gray
                        default           => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),
                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->color(fn(string $state): string => match ($state) {
                        'draft'     => 'gray',
                        'active'    => 'success',
                        'paused'    => 'warning',
                        'completed' => 'info',
                        'cancelled' => 'danger',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'draft'     => 'Draft',
                        'active'    => 'In Progress',
                        'paused'    => 'On Hold',
                        'completed' => 'Finished',
                        'cancelled' => 'Cancelled',
                        default     => ucfirst($state),
                    }),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('featured')
                    ->sortable()
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedCheckCircle)
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'education' => 'Education',
                        'health' => 'Health',
                        'environment' => 'Environment',
                        'poverty' => 'Poverty',
                        'disaster_relief' => 'Disaster Relief',
                        'community' => 'Community',
                        'other' => 'Other',
                    ])
                    ->native(false),
                SelectFilter::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'active'    => 'In Progress',
                        'paused'    => 'On Hold',
                        'completed' => 'Finished',
                        'cancelled' => 'Cancelled',
                    ])
                    ->native(false)
            ])
            ->deferFilters(false)
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
