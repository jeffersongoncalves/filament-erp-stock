<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class PutawayRuleForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
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
