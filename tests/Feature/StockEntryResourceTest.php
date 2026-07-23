<?php

use JeffersonGoncalves\Erp\Accounting\Models\Account;
use JeffersonGoncalves\Erp\Accounting\Models\GlEntry;
use JeffersonGoncalves\Erp\Accounting\Services\GeneralLedgerService;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\Erp\Stock\Enums\StockEntryType;
use JeffersonGoncalves\Erp\Stock\Models\Bin;
use JeffersonGoncalves\Erp\Stock\Models\Item;
use JeffersonGoncalves\Erp\Stock\Models\StockEntry;
use JeffersonGoncalves\Erp\Stock\Models\StockLedgerEntry;
use JeffersonGoncalves\Erp\Stock\Models\Warehouse;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Pages\CreateStockEntry;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Pages\EditStockEntry;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Pages\ListStockEntries;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
    $this->stockAccount = Account::factory()->create(['company_id' => $this->company->id]);
    $this->counter = Account::factory()->create(['company_id' => $this->company->id]);
    $this->warehouse = Warehouse::factory()->create([
        'company_id' => $this->company->id,
        'account_id' => $this->stockAccount->id,
    ]);
    $this->item = Item::factory()->create();
});

function makeReceipt(): StockEntry
{
    $entry = StockEntry::factory()->type(StockEntryType::MaterialReceipt)->create([
        'company_id' => test()->company->id,
        'to_warehouse_id' => test()->warehouse->id,
    ]);

    $entry->items()->create([
        'item_id' => test()->item->id,
        't_warehouse_id' => test()->warehouse->id,
        'qty' => 8,
        'basic_rate' => 12.5,
    ]);

    return $entry->refresh();
}

it('can render the stock entry list page', function () {
    Livewire::test(ListStockEntries::class)->assertSuccessful();
});

it('can render the stock entry create page', function () {
    Livewire::test(CreateStockEntry::class)->assertSuccessful();
});

it('can render the stock entry edit page', function () {
    $entry = makeReceipt();

    Livewire::test(EditStockEntry::class, ['record' => $entry->getRouteKey()])
        ->assertSuccessful();
});

it('submits a material receipt through the UI and posts the stock ledger, bin and general ledger', function () {
    $entry = makeReceipt();

    Livewire::test(ListStockEntries::class)
        ->callTableAction('submit', $entry, [
            'counter_account_id' => $this->counter->id,
        ]);

    // (a) the document is submitted
    expect($entry->refresh()->docstatus)->toBe(DocStatus::Submitted);

    // (b) a stock ledger entry exists with the correct running quantity and rate
    $sle = StockLedgerEntry::query()
        ->where('item_id', $this->item->id)
        ->where('warehouse_id', $this->warehouse->id)
        ->where('is_cancelled', false)
        ->first();

    expect($sle)->not->toBeNull()
        ->and($sle->qty_after_transaction)->toBe(8.0)
        ->and($sle->valuation_rate)->toBe(12.5);

    // (c) the bin reflects the on-hand quantity and value
    $bin = Bin::query()
        ->where('item_id', $this->item->id)
        ->where('warehouse_id', $this->warehouse->id)
        ->first();

    expect($bin)->not->toBeNull()
        ->and($bin->actual_qty)->toBe(8.0)
        ->and($bin->valuation_rate)->toBe(12.5)
        ->and($bin->stock_value)->toBe(100.0);

    // (d) a balanced pair of general ledger entries was posted
    $gl = GlEntry::query()
        ->where('voucherable_type', $entry->getMorphClass())
        ->where('voucherable_id', $entry->getKey())
        ->where('is_cancelled', false);

    expect((clone $gl)->count())->toBe(2)
        ->and((float) (clone $gl)->sum('debit'))->toBe(100.0)
        ->and((float) (clone $gl)->sum('credit'))->toBe(100.0)
        ->and(app(GeneralLedgerService::class)->accountBalance($this->stockAccount))->toBe(100.0)
        ->and(app(GeneralLedgerService::class)->accountBalance($this->counter))->toBe(-100.0);
});

it('cancels a submitted receipt through the UI, reverting the bin and reversing the ledger', function () {
    $entry = makeReceipt();

    Livewire::test(ListStockEntries::class)
        ->callTableAction('submit', $entry, [
            'counter_account_id' => $this->counter->id,
        ]);

    expect($entry->refresh()->docstatus)->toBe(DocStatus::Submitted);

    Livewire::test(ListStockEntries::class)
        ->callTableAction('cancel', $entry);

    expect($entry->refresh()->docstatus)->toBe(DocStatus::Cancelled);

    // the stock ledger is flagged cancelled and the bin is emptied
    $bin = Bin::query()
        ->where('item_id', $this->item->id)
        ->where('warehouse_id', $this->warehouse->id)
        ->first();

    expect(StockLedgerEntry::query()->where('is_cancelled', false)->count())->toBe(0)
        ->and($bin->actual_qty)->toBe(0.0)
        ->and($bin->stock_value)->toBe(0.0)
        ->and(app(GeneralLedgerService::class)->accountBalance($this->stockAccount))->toBe(0.0)
        ->and(app(GeneralLedgerService::class)->accountBalance($this->counter))->toBe(0.0);
});
