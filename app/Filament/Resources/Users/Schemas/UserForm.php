<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email Address')
                    ->required()
                    ->maxLength(255)
                    ->email()
                    ->unique(User::class, 'email', ignoreRecord: true),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->dehydrated(fn(?string $state): bool => filled($state))
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->minLength(8)
                    ->maxLength(255)
                    ->revealable(),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    // ->multiple()
                    ->preload()
                    ->searchable()
            ]);
    }
}
