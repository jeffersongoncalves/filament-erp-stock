<?php

use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\Pages\ListStockLedgerEntries;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\StockLedgerEntryResource;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the stock ledger list page', function () {
    Livewire::test(ListStockLedgerEntries::class)->assertSuccessful();
});

it('is a read-only resource without create or edit capability', function () {
    expect(StockLedgerEntryResource::canCreate())->toBeFalse()
        ->and(StockLedgerEntryResource::getPages())->toHaveKeys(['index', 'view'])
        ->and(StockLedgerEntryResource::getPages())->not->toHaveKey('create');
});
