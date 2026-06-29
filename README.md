<div class="filament-hidden">

![Filament ERP Stock](https://raw.githubusercontent.com/jeffersongoncalves/filament-erp-stock/3.x/art/jeffersongoncalves-filament-erp-stock.png)

</div>

# Filament ERP Stock

Filament v5 panel resources for the [Laravel ERP stock module](https://github.com/jeffersongoncalves/laravel-erp-stock) — items, warehouses, stock entries and the perpetual inventory ledger.

This package is the UI layer for the `jeffersongoncalves/laravel-erp-stock` domain package (namespace `JeffersonGoncalves\Erp\Stock\`). It wires the stock models into Filament resources, with Submit/Cancel actions that post the stock ledger, update bins and write the balanced general-ledger impact.

## Features

- **Master resources** — Items, warehouses, price lists, item prices, batches and serial numbers
- **Transaction resources** — Stock entries, material requests, delivery notes, purchase receipts and stock reconciliations, each with an Items relation manager
- **Perpetual inventory** — Read-only stock ledger entry viewer and live per-item/warehouse bin balances
- **Submit & Cancel actions** — Drive the domain document lifecycle; ledger-posting documents collect the counter GL account in the submit modal
- **Dashboard widgets** — Total stock value and low-stock alerts

## Compatibility

| Package | PHP | Filament | Laravel |
|---------|-----|----------|---------|
| `^3.0`  | `^8.2` | `^5.0` | `^11.0 \| ^12.0 \| ^13.0` |

## Installation

Install the package via Composer:

```bash
composer require jeffersongoncalves/filament-erp-stock
```

Register the plugin on a Filament panel:

```php
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;

$panel->plugin(
    FilamentErpStockPlugin::make()
        ->navigationGroup('ERP — Stock'),
);
```

## Resources

| Resource | Purpose |
|----------|---------|
| `ItemResource` | Items (UOM, valuation method, batch/serial flags, default warehouse, brand) |
| `WarehouseResource` | Warehouses (tree via parent, inventory GL account) |
| `PriceListResource` | Price lists (selling/buying) |
| `ItemPriceResource` | Item prices |
| `BatchResource` | Batches |
| `SerialNoResource` | Serial numbers |
| `StockEntryResource` | Stock entries (+ Details RM, Submit/Cancel) |
| `MaterialRequestResource` | Material requests (+ Items RM, Submit/Cancel — no ledger) |
| `DeliveryNoteResource` | Delivery notes (+ Items RM, Submit/Cancel — outbound + COGS) |
| `PurchaseReceiptResource` | Purchase receipts (+ Items RM, Submit/Cancel — inbound) |
| `StockReconciliationResource` | Stock reconciliations (+ Items RM, Submit/Cancel) |
| `StockLedgerEntryResource` | Read-only perpetual inventory ledger viewer |
| `BinResource` | Read-only live stock balance (per item/warehouse) |

Transaction resources expose **Submit** and **Cancel** record actions that drive the domain document lifecycle. Ledger-posting documents collect the offsetting (counter) GL account in the submit modal; submitting writes the stock ledger entries, updates the bins and posts the balanced general-ledger impact, while cancelling reverses all three.

## Widgets

| Widget | Purpose |
|--------|---------|
| `StockBalanceWidget` | Total stock value and number of items in stock |
| `LowStockWidget` | Count of bins at or below the reorder threshold |

## Configuration

Publish the config to swap resource classes, change the navigation group, or adjust widgets:

```bash
php artisan vendor:publish --tag="filament-erp-stock-config"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Jefferson Simão Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
