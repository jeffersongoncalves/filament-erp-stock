<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class ItemPriceForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        Select::make('item_id')
                            ->label('Item')
                            ->relationship('item', 'item_name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('price_list_id')
                            ->label('Price List')
                            ->relationship('priceList', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('rate')
                            ->numeric()
                            ->default(0),
                        TextInput::make('currency')
                            ->maxLength(3)
                            ->default('USD'),
                        DatePicker::make('valid_from')
                            ->label('Valid From')
                            ->nullable(),
                        DatePicker::make('valid_upto')
                            ->label('Valid Upto')
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
