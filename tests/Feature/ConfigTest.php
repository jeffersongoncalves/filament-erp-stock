<?php

it('loads the filament-erp-stock config file', function () {
    expect(config('filament-erp-stock'))->toBeArray();
});

it('has a default navigation group', function () {
    expect(config('filament-erp-stock.navigation_group'))->toBe('ERP — Stock');
});

it('registers all resources in config', function () {
    $resources = config('filament-erp-stock.resources');

    expect($resources)->toBeArray()
        ->toHaveKeys([
            'item',
            'warehouse',
            'price_list',
            'item_price',
            'batch',
            'serial_no',
            'stock_entry',
            'material_request',
            'delivery_note',
            'purchase_receipt',
            'stock_reconciliation',
            'stock_ledger_entry',
            'bin',
        ]);
});

it('registers the dashboard widgets in config', function () {
    expect(config('filament-erp-stock.widgets'))->toBeArray()
        ->toHaveKeys(['stock_balance', 'low_stock']);
});
