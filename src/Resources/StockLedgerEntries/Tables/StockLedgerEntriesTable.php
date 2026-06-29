<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StockLedgerEntriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('posting_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('item.item_name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('warehouse.name')
                    ->label('Warehouse')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('actual_qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('qty_after_transaction')
                    ->label('Qty After Txn')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('valuation_rate')
                    ->numeric(),
                TextColumn::make('stock_value')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('voucherable_type')
                    ->label('Voucher Type')
                    ->formatStateUsing(fn (?string $state): string => $state === null ? '' : class_basename($state))
                    ->toggleable(),
                TextColumn::make('voucherable_id')
                    ->label('Voucher')
                    ->toggleable(),
                IconColumn::make('is_cancelled')
                    ->label('Cancelled')
                    ->boolean(),
            ])
            ->defaultSort('posting_date', 'desc')
            ->filters([
                SelectFilter::make('item')
                    ->label('Item')
                    ->relationship('item', 'item_name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('warehouse')
                    ->label('Warehouse')
                    ->relationship('warehouse', 'name')
                    ->searchable()
                    ->preload(),
                TernaryFilter::make('is_cancelled')
                    ->label('Cancelled'),
                Filter::make('posting_date')
                    ->form([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $q, $date): Builder => $q->whereDate('posting_date', '>=', $date),
                            )
                            ->when(
                                $data['until'] ?? null,
                                fn (Builder $q, $date): Builder => $q->whereDate('posting_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Actions\ViewAction::make(),
            ]);
    }
}
