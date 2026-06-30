<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ItemPricesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item.item_name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('priceList.name')
                    ->label('Price List')
                    ->sortable(),
                TextColumn::make('rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('currency'),
                TextColumn::make('valid_from')
                    ->label('Valid From')
                    ->date()
                    ->toggleable(),
                TextColumn::make('valid_upto')
                    ->label('Valid Upto')
                    ->date()
                    ->toggleable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('item')
                    ->label('Item')
                    ->relationship('item', 'item_name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('price_list')
                    ->label('Price List')
                    ->relationship('priceList', 'name'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
