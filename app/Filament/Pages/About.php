<?php

namespace App\Filament\Pages;

use App\Models\About as AboutModel;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class About extends Page
{
    protected string $view = 'filament.pages.about';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::Identification;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getRecord()?->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('about-images')
                        ->required(),
                    Textarea::make('description')
                        ->required(),
                    Repeater::make('mission')
                        ->addActionLabel('Add Mission')
                        ->table([
                            TableColumn::make('name')->alignStart()->hiddenHeaderLabel(),
                        ])
                        ->required()
                        ->compact()
                        ->schema([
                            TextInput::make('name')
                                ->required(),
                        ])->columnSpanFull(),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $record = $this->getRecord();

        if (!$record) {
            $record = new AboutModel();
        }

        $record->fill($data);
        $record->save();

        if ($record->wasRecentlyCreated) {
            $this->form->record($record)->saveRelationships();
        }

        Notification::make()
            ->success()
            ->title('Saved')
            ->send();
    }

    public function getRecord(): ?AboutModel
    {
        return AboutModel::query()->first();
    }
}
