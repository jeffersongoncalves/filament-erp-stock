<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class StockLedgerEntryInfolist
{
    public static function configure(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(null)
            ->schema([
                Section::make('Ledger Entry')
                    ->schema([
                        TextEntry::make('posting_date')
                            ->label('Date')
                            ->date(),
                        TextEntry::make('item.item_name')
                            ->label('Item'),
                        TextEntry::make('warehouse.name')
                            ->label('Warehouse'),
                        TextEntry::make('actual_qty')
                            ->numeric(),
                        TextEntry::make('qty_after_transaction')
                            ->label('Qty After Transaction')
                            ->numeric(),
                        TextEntry::make('incoming_rate')
                            ->numeric(),
                        TextEntry::make('valuation_rate')
                            ->numeric(),
                        TextEntry::make('stock_value')
                            ->numeric(),
                        TextEntry::make('voucherable_type')
                            ->label('Voucher Type')
                            ->formatStateUsing(fn (?string $state): string => $state === null ? '' : class_basename($state)),
                        TextEntry::make('voucherable_id')
                            ->label('Voucher ID'),
                        TextEntry::make('company.name')
                            ->label('Company')
                            ->placeholder('—'),
                        IconEntry::make('is_cancelled')
                            ->label('Cancelled')
                            ->boolean(),
                    ])->columns(2),
            ]);
    }
}
