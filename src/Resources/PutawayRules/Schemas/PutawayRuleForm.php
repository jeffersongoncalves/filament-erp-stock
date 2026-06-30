<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PutawayRuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
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
                            ->required(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('stock_uom_id')
                            ->label('Stock UOM')
                            ->relationship('stockUom', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('capacity')
                            ->label('Capacity')
                            ->numeric()
                            ->default(0),
                        TextInput::make('priority')
                            ->label('Priority')
                            ->numeric()
                            ->default(1),
                        Toggle::make('disabled')
                            ->label('Disabled')
                            ->default(false),
                    ])->columns(2),
            ]);
    }
}
