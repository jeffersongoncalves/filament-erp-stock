<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class PackingSlipForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        Select::make('delivery_note_id')
                            ->label('Delivery Note')
                            ->relationship('deliveryNote', 'customer_name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('from_case_no')
                            ->label('From Case No')
                            ->numeric()
                            ->default(1),
                        TextInput::make('to_case_no')
                            ->label('To Case No')
                            ->numeric()
                            ->default(1),
                        TextInput::make('net_weight')
                            ->label('Net Weight')
                            ->numeric()
                            ->default(0),
                        TextInput::make('gross_weight')
                            ->label('Gross Weight')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }
}
