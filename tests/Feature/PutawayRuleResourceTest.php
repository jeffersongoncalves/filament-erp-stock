<?php

use JeffersonGoncalves\Erp\Stock\Models\Item;
use JeffersonGoncalves\Erp\Stock\Models\PutawayRule;
use JeffersonGoncalves\Erp\Stock\Models\Warehouse;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Pages\CreatePutawayRule;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Pages\EditPutawayRule;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Pages\ListPutawayRules;
use JeffersonGoncalves\FilamentErp\Stock\Tests\Fixtures\StockMigrations;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    StockMigrations::ensureAll();
});

it('can render the putaway rule list page', function () {
    Livewire::test(ListPutawayRules::class)->assertSuccessful();
});

it('can render the putaway rule create page', function () {
    Livewire::test(CreatePutawayRule::class)->assertSuccessful();
});

it('can create a putaway rule', function () {
    $item = Item::factory()->create();
    $warehouse = Warehouse::factory()->create();

    Livewire::test(CreatePutawayRule::class)
        ->fillForm([
            'item_id' => $item->id,
            'warehouse_id' => $warehouse->id,
            'capacity' => 250,
            'priority' => 2,
            'disabled' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(PutawayRule::query()
        ->where('item_id', $item->id)
        ->where('warehouse_id', $warehouse->id)
        ->where('capacity', 250)
        ->exists())->toBeTrue();
});

it('can render the putaway rule edit page', function () {
    $rule = PutawayRule::factory()->create();

    Livewire::test(EditPutawayRule::class, ['record' => $rule->getRouteKey()])
        ->assertSuccessful();
});
