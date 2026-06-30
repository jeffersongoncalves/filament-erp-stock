<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('batch_id')
                            ->label('Batch ID')
                            ->required()
                            ->maxLength(255),
                        Select::make('item_id')
                            ->label('Item')
                            ->relationship('item', 'item_name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        DatePicker::make('manufacturing_date')
                            ->label('Manufacturing Date')
                            ->nullable(),
                        DatePicker::make('expiry_date')
                            ->label('Expiry Date')
                            ->nullable(),
                        TextInput::make('batch_qty')
                            ->label('Batch Qty')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }
}
