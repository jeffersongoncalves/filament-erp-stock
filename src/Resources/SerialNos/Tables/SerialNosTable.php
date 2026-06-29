<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Enums\SerialNoStatus;

class SerialNosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_no')
                    ->label('Serial No')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('item.item_name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('warehouse.name')
                    ->label('Warehouse')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof SerialNoStatus ? $state->value : (string) $state),
                TextColumn::make('purchase_rate')
                    ->label('Purchase Rate')
                    ->numeric()
                    ->toggleable(),
            ])
            ->defaultSort('serial_no')
            ->filters([
                SelectFilter::make('status')
                    ->options(self::statusOptions()),
                SelectFilter::make('warehouse')
                    ->label('Warehouse')
                    ->relationship('warehouse', 'name'),
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
