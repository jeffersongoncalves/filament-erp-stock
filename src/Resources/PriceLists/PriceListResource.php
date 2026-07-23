<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\Pages\CreatePriceList;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\Pages\EditPriceList;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\Pages\ListPriceLists;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\Schemas\PriceListForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\Tables\PriceListsTable;

class PriceListResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::priceList();
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
        return PriceListForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return PriceListsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPriceLists::route('/'),
            'create' => CreatePriceList::route('/create'),
            'edit' => EditPriceList::route('/{record}/edit'),
        ];
    }
}
