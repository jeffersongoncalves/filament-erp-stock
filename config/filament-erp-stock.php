<?php

use JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\BatchResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\BinResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\DeliveryNoteResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\ItemPriceResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\ItemResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\MaterialRequestResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\PriceListResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\PurchaseReceiptResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\SerialNoResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\StockEntryResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\StockLedgerEntryResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\StockReconciliationResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\WarehouseResource;
use JeffersonGoncalves\FilamentErp\Stock\Widgets\LowStockWidget;
use JeffersonGoncalves\FilamentErp\Stock\Widgets\StockBalanceWidget;

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | The navigation group under which all ERP stock resources are listed in the
    | Filament panel. Override per-plugin with ->navigationGroup('...').
    |
    */

    'navigation_group' => 'ERP — Stock',

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | The Filament resource classes registered by the plugin. Each entry can be
    | swapped for a custom resource extending the default one.
    |
    */

    'resources' => [
        'item' => ItemResource::class,
        'warehouse' => WarehouseResource::class,
        'price_list' => PriceListResource::class,
        'item_price' => ItemPriceResource::class,
        'batch' => BatchResource::class,
        'serial_no' => SerialNoResource::class,
        'stock_entry' => StockEntryResource::class,
        'material_request' => MaterialRequestResource::class,
        'delivery_note' => DeliveryNoteResource::class,
        'purchase_receipt' => PurchaseReceiptResource::class,
        'stock_reconciliation' => StockReconciliationResource::class,
        'stock_ledger_entry' => StockLedgerEntryResource::class,
        'bin' => BinResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | The Filament widgets registered by the plugin on the panel dashboard.
    |
    */

    'widgets' => [
        'stock_balance' => StockBalanceWidget::class,
        'low_stock' => LowStockWidget::class,
    ],

];
