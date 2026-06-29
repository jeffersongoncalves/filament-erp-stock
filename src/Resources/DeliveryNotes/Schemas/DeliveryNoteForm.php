<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DeliveryNoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
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
