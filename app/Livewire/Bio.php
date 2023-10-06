<?php

namespace App\Livewire;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class Bio extends MyProfileComponent
{
    protected string $view = "livewire.bio";

    public array $data;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('bio'),
                Repeater::make('links')
                    ->label('Social media links')
                    ->addActionLabel('Add your links')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('platform')
                            ->options([
                                'x',
                                'facebook',
                                'youtube',
                                'linkedin',
                                'instagram',
                                'portfolio',
                            ]),
                        TextInput::make('link')
                    ])->columns(2)
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.bio');
    }
}
