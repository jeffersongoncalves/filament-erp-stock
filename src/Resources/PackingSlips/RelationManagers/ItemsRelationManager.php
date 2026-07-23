<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Items';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Select::make('item_id')
                    ->label('Item')
                    ->relationship('item', 'item_name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('qty')
                    ->label('Qty')
                    ->numeric()
                    ->default(0),
                TextInput::make('batch_no')
                    ->label('Batch No')
                    ->maxLength(255),
                TextInput::make('serial_no')
                    ->label('Serial No')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('item_id')
            ->columns([
                TextColumn::make('item.item_name')
                    ->label('Item')
                    ->searchable(),
                TextColumn::make('qty')
                    ->numeric(),
                TextColumn::make('batch_no')
                    ->label('Batch No')
                    ->toggleable(),
                TextColumn::make('serial_no')
                    ->label('Serial No')
                    ->toggleable(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
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
