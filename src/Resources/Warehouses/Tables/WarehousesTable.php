<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class WarehousesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('parent.name')
                    ->label('Parent')
                    ->toggleable()
                    ->sortable(),
                IconColumn::make('is_group')
                    ->label('Group')
                    ->boolean(),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('account.name')
                    ->label('Account')
                    ->toggleable(),
                IconColumn::make('disabled')
                    ->label('Disabled')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('is_group')
                    ->label('Is Group'),
                TernaryFilter::make('disabled')
                    ->label('Disabled'),
                SelectFilter::make('company')
                    ->label('Company')
                    ->relationship('company', 'name'),
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
