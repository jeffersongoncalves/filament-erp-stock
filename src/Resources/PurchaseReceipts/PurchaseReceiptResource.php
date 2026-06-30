<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\Pages\CreatePurchaseReceipt;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\Pages\EditPurchaseReceipt;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\Pages\ListPurchaseReceipts;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\RelationManagers\ItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\Schemas\PurchaseReceiptForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\Tables\PurchaseReceiptsTable;

class PurchaseReceiptResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxArrowDown;

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'supplier_name';

    public static function getModel(): string
    {
        return ModelResolver::purchaseReceipt();
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
        return PurchaseReceiptForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PurchaseReceiptsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPurchaseReceipts::route('/'),
            'create' => CreatePurchaseReceipt::route('/create'),
            'edit' => EditPurchaseReceipt::route('/{record}/edit'),
        ];
    }
}
