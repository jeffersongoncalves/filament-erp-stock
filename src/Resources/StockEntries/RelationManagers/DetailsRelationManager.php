<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;

class DetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('item_id')
                    ->label('Item')
                    ->relationship('item', 'item_name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('uom_id')
                    ->label('UOM')
                    ->relationship('uom', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Select::make('s_warehouse_id')
                    ->label('Source Warehouse')
                    ->options(self::warehouseOptions())
                    ->searchable()
                    ->nullable(),
                Select::make('t_warehouse_id')
                    ->label('Target Warehouse')
                    ->options(self::warehouseOptions())
                    ->searchable()
                    ->nullable(),
                TextInput::make('qty')
                    ->label('Qty')
                    ->numeric()
                    ->default(0),
                TextInput::make('basic_rate')
                    ->label('Basic Rate')
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
        $warehouses = self::warehouseOptions();

        return $table
            ->recordTitleAttribute('item_id')
            ->columns([
                TextColumn::make('item.item_name')
                    ->label('Item')
                    ->searchable(),
                TextColumn::make('s_warehouse_id')
                    ->label('Source')
                    ->formatStateUsing(fn ($state): string => $warehouses[$state] ?? '—')
                    ->toggleable(),
                TextColumn::make('t_warehouse_id')
                    ->label('Target')
                    ->formatStateUsing(fn ($state): string => $warehouses[$state] ?? '—')
                    ->toggleable(),
                TextColumn::make('qty')
                    ->numeric(),
                TextColumn::make('uom.name')
                    ->label('UOM')
                    ->toggleable(),
                TextColumn::make('basic_rate')
                    ->label('Basic Rate')
                    ->numeric(),
                TextColumn::make('amount')
                    ->numeric(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
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

    /** @return array<int, string> */
    protected static function warehouseOptions(): array
    {
        /** @var array<int, string> $options */
        $options = ModelResolver::warehouse()::query()
            ->orderBy('name')
            ->pluck('name', 'id')
            ->all();

        return $options;
    }
}
