<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class BatchForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
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
