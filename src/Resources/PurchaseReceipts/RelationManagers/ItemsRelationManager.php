<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\RelationManagers;

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
                Select::make('warehouse_id')
                    ->label('Warehouse')
                    ->relationship('warehouse', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('qty')
                    ->label('Qty')
                    ->numeric()
                    ->default(0),
                TextInput::make('rate')
                    ->label('Rate')
                    ->numeric()
                    ->default(0),
                TextInput::make('amount')
                    ->label('Amount')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),
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
                TextColumn::make('rate')
                    ->numeric(),
                TextColumn::make('amount')
                    ->numeric(),
                TextColumn::make('warehouse.name')
                    ->label('Warehouse')
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
