<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Pages\CreateWarehouse;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Pages\EditWarehouse;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Pages\ListWarehouses;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Schemas\WarehouseForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Tables\WarehousesTable;

class WarehouseResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::warehouse();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpStockPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-stock.navigation_group', 'ERP — Stock');
        }
    }

    public static function form(Schema $schema): Schema
    {
        return WarehouseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WarehousesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWarehouses::route('/'),
            'create' => CreateWarehouse::route('/create'),
            'edit' => EditWarehouse::route('/{record}/edit'),
        ];
    }
}
