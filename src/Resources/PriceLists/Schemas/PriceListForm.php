<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PriceListForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
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
