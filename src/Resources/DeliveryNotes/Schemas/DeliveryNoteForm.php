<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class DeliveryNoteForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Customer Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('party_id')
                            ->label('Customer ID')
                            ->numeric(),
                        DateTimePicker::make('posting_date')
                            ->label('Posting Date')
                            ->required()
                            ->default(now()),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('set_warehouse_id')
                            ->label('Source Warehouse')
                            ->relationship('setWarehouse', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
