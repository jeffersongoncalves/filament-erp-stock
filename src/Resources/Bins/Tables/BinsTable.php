<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BinsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
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
                TextColumn::make('valuation_rate')
                    ->numeric(),
                TextColumn::make('stock_value')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reserved_qty')
                    ->numeric()
                    ->toggleable(),
            ])
            ->defaultSort('item_id')
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
            ])
            ->actions([]);
    }
}
