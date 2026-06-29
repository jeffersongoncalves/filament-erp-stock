<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Erp\Stock\Enums\StockEntryType;

class StockEntryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        Select::make('stock_entry_type')
                            ->label('Stock Entry Type')
                            ->options(self::stockEntryTypeOptions())
                            ->default(StockEntryType::MaterialReceipt->value)
                            ->required(),
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
                        Select::make('from_warehouse_id')
                            ->label('From Warehouse')
                            ->relationship('fromWarehouse', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('to_warehouse_id')
                            ->label('To Warehouse')
                            ->relationship('toWarehouse', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }

    /** @return array<string, string> */
    protected static function stockEntryTypeOptions(): array
    {
        $options = [];

        foreach (StockEntryType::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
