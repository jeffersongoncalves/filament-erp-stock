<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\FilamentErp\Core\Concerns\SubmittableRecordActions;

class PackingSlipsTable
{
    use SubmittableRecordActions;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('deliveryNote.customer_name')
                    ->label('Delivery Note')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('from_case_no')
                    ->label('From Case')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('to_case_no')
                    ->label('To Case')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('net_weight')
                    ->label('Net Weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('gross_weight')
                    ->label('Gross Weight')
                    ->numeric()
                    ->sortable(),
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
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('docstatus')
                    ->label('Status')
                    ->options([
                        0 => 'Draft',
                        1 => 'Submitted',
                        2 => 'Cancelled',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
                ...self::submittableRecordActions(),
                Actions\DeleteAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
            ]);
    }
}
