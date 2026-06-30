<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class PriceListForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('currency')
                            ->maxLength(3)
                            ->default('USD'),
                        Toggle::make('enabled')
                            ->default(true),
                        Toggle::make('is_selling')
                            ->label('Is Selling')
                            ->default(false),
                        Toggle::make('is_buying')
                            ->label('Is Buying')
                            ->default(false),
                    ])->columns(2),
            ]);
    }
}
