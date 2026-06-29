<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use JeffersonGoncalves\Erp\Stock\Enums\ValuationMethod;

class ItemForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('item_code')
                            ->label('Item Code')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('item_name')
                            ->label('Item Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('item_group')
                            ->label('Item Group')
                            ->maxLength(255),
                        Select::make('stock_uom_id')
                            ->label('Stock UOM')
                            ->relationship('stockUom', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('valuation_method')
                            ->label('Valuation Method')
                            ->options(self::valuationMethodOptions())
                            ->nullable(),
                        TextInput::make('standard_rate')
                            ->label('Standard Rate')
                            ->numeric()
                            ->default(0),
                        Select::make('default_warehouse_id')
                            ->label('Default Warehouse')
                            ->relationship('defaultWarehouse', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('brand_id')
                            ->label('Brand')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
                Section::make('Options')
                    ->schema([
                        Toggle::make('is_stock_item')
                            ->label('Is Stock Item')
                            ->default(true),
                        Toggle::make('has_batch_no')
                            ->label('Has Batch No')
                            ->default(false),
                        Toggle::make('has_serial_no')
                            ->label('Has Serial No')
                            ->default(false),
                        Toggle::make('disabled')
                            ->label('Disabled')
                            ->default(false),
                        FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->columnSpanFull(),
                    ])->columns(2),
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
