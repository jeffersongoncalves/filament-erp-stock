<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Enums\ValuationMethod;

class ItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item_code')
                    ->label('Item Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('item_name')
                    ->label('Item Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('item_group')
                    ->label('Group')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('stockUom.name')
                    ->label('Stock UOM')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('valuation_method')
                    ->label('Valuation')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof ValuationMethod ? $state->value : (string) $state)
                    ->toggleable(),
                IconColumn::make('is_stock_item')
                    ->label('Stock Item')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('disabled')
                    ->label('Disabled')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('item_code')
            ->filters([
                SelectFilter::make('valuation_method')
                    ->label('Valuation Method')
                    ->options(self::valuationMethodOptions()),
                TernaryFilter::make('is_stock_item')
                    ->label('Is Stock Item'),
                TernaryFilter::make('disabled')
                    ->label('Disabled'),
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

    /** @return array<string, string> */
    protected static function valuationMethodOptions(): array
    {
        $options = [];

        foreach (ValuationMethod::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
