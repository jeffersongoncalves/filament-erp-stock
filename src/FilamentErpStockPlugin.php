<?php

namespace JeffersonGoncalves\FilamentErp\Stock;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentErp\Stock\Concerns\HasErpStockPluginConfig;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\BatchResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\BinResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\DeliveryNoteResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\ItemPriceResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\ItemResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\MaterialRequestResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\PackingSlipResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PriceLists\PriceListResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\PurchaseReceiptResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\PutawayRuleResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\SerialNoResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\ShipmentResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\StockEntryResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\StockLedgerEntryResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\StockReconciliationResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\WarehouseResource;

class FilamentErpStockPlugin implements Plugin
{
    use HasErpStockPluginConfig;

    public function getId(): string
    {
        return 'filament-erp-stock';
    }

    public function register(Panel $panel): void
    {
        $panel->resources($this->resolveResources([
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
            'putaway_rule' => PutawayRuleResource::class,
            'shipment' => ShipmentResource::class,
            'packing_slip' => PackingSlipResource::class,
        ]));

        $panel->widgets($this->resolveWidgets());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
