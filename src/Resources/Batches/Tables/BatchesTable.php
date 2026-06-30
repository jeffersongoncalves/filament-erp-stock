<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BatchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('batch_id')
                    ->label('Batch ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('item.item_name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('batch_qty')
                    ->label('Batch Qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('manufacturing_date')
                    ->label('Manufactured')
                    ->date()
                    ->toggleable(),
                TextColumn::make('expiry_date')
                    ->label('Expiry')
                    ->date()
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('batch_id')
            ->filters([
                SelectFilter::make('item')
                    ->label('Item')
                    ->relationship('item', 'item_name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
