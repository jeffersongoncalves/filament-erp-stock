<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class WarehouseForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Select::make('parent_warehouse_id')
                            ->label('Parent Warehouse')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('account_id')
                            ->label('Account')
                            ->helperText('Inventory GL account')
                            ->relationship('account', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Toggle::make('is_group')
                            ->label('Is Group')
                            ->default(false),
                        Toggle::make('disabled')
                            ->label('Disabled')
                            ->default(false),
                    ])->columns(2),
            ]);
    }
}
