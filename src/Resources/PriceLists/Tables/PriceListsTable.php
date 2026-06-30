<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PriceListsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('currency')
                    ->sortable(),
                IconColumn::make('enabled')
                    ->boolean(),
                IconColumn::make('is_selling')
                    ->label('Selling')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('is_buying')
                    ->label('Buying')
                    ->boolean()
                    ->toggleable(),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('enabled'),
                TernaryFilter::make('is_selling')
                    ->label('Is Selling'),
                TernaryFilter::make('is_buying')
                    ->label('Is Buying'),
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
