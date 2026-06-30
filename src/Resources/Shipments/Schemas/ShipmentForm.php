<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class ShipmentForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        DatePicker::make('shipment_date')
                            ->label('Shipment Date')
                            ->required()
                            ->default(now()),
                        TextInput::make('pickup_from_type')
                            ->label('Pickup From Type')
                            ->default('Company')
                            ->maxLength(255),
                        TextInput::make('delivery_to_type')
                            ->label('Delivery To Type')
                            ->default('Customer')
                            ->maxLength(255),
                        TextInput::make('party_type')
                            ->label('Party Type')
                            ->maxLength(255),
                        TextInput::make('party_id')
                            ->label('Party ID')
                            ->numeric(),
                        TextInput::make('value_of_goods')
                            ->label('Value of Goods')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }
}
