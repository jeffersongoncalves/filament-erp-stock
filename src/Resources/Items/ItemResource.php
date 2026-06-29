<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Items;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Pages\CreateItem;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Pages\EditItem;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Pages\ListItems;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Schemas\ItemForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Tables\ItemsTable;

class ItemResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'item_name';

    public static function getModel(): string
    {
        return ModelResolver::item();
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
        return ItemForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ItemsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItems::route('/'),
            'create' => CreateItem::route('/create'),
            'edit' => EditItem::route('/{record}/edit'),
        ];
    }
}
