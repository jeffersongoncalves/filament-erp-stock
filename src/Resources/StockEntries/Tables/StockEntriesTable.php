<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Stock\Enums\StockEntryType;
use JeffersonGoncalves\FilamentErp\Stock\Concerns\PostsStockLedgerActions;

class StockEntriesTable
{
    use PostsStockLedgerActions;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('posting_date')
                    ->label('Posting Date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('stock_entry_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof StockEntryType ? $state->value : (string) $state),
                TextColumn::make('toWarehouse.name')
                    ->label('To Warehouse')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('fromWarehouse.name')
                    ->label('From Warehouse')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('total_incoming_value')
                    ->label('Incoming Value')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('total_outgoing_value')
                    ->label('Outgoing Value')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('docstatus')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof DocStatus ? $state->name : $state)
                    ->color(fn ($state) => match ($state) {
                        DocStatus::Draft => 'gray',
                        DocStatus::Submitted => 'success',
                        DocStatus::Cancelled => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('posting_date', 'desc')
            ->filters([
                SelectFilter::make('stock_entry_type')
                    ->label('Type')
                    ->options(self::stockEntryTypeOptions()),
                SelectFilter::make('docstatus')
                    ->label('Status')
                    ->options([
                        0 => 'Draft',
                        1 => 'Submitted',
                        2 => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                Actions\EditAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
                ...self::submittableRecordActions(),
                Actions\DeleteAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
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
