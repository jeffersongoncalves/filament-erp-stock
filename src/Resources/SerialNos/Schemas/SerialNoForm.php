<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use JeffersonGoncalves\Erp\Stock\Enums\SerialNoStatus;

class SerialNoForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('serial_no')
                            ->label('Serial No')
                            ->required()
                            ->maxLength(255),
                        Select::make('item_id')
                            ->label('Item')
                            ->relationship('item', 'item_name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('warehouse_id')
                            ->label('Warehouse')
                            ->relationship('warehouse', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('status')
                            ->options(self::statusOptions())
                            ->default(SerialNoStatus::Active->value),
                        TextInput::make('purchase_rate')
                            ->label('Purchase Rate')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    /** @return array<string, string> */
    protected static function statusOptions(): array
    {
        $options = [];

        foreach (SerialNoStatus::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
