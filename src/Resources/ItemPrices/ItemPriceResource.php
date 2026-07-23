<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Pages\CreateItemPrice;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Pages\EditItemPrice;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Pages\ListItemPrices;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Schemas\ItemPriceForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Tables\ItemPricesTable;

class ItemPriceResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getModel(): string
    {
        return ModelResolver::itemPrice();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpStockPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-stock.navigation_group', 'ERP — Stock');
        }
    }

    public static function form(Form $form): Form
    {
        return ItemPriceForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ItemPricesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItemPrices::route('/'),
            'create' => CreateItemPrice::route('/create'),
            'edit' => EditItemPrice::route('/{record}/edit'),
        ];
    }
}
