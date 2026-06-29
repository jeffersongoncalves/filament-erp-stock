<?php

use JeffersonGoncalves\Erp\Stock\Models\Item;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Pages\CreateItem;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Pages\EditItem;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Items\Pages\ListItems;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the item list page', function () {
    Livewire::test(ListItems::class)->assertSuccessful();
});

it('can list items in the table', function () {
    $item = Item::factory()->create();

    Livewire::test(ListItems::class)
        ->assertCanSeeTableRecords([$item]);
});

it('can render the item create page', function () {
    Livewire::test(CreateItem::class)->assertSuccessful();
});

it('can create an item', function () {
    Livewire::test(CreateItem::class)
        ->fillForm([
            'item_code' => 'WIDGET-001',
            'item_name' => 'Widget',
            'is_stock_item' => true,
            'standard_rate' => 25,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Item::query()->where('item_code', 'WIDGET-001')->exists())->toBeTrue();
});

it('can render the item edit page', function () {
    $item = Item::factory()->create();

    Livewire::test(EditItem::class, ['record' => $item->getRouteKey()])
        ->assertSuccessful();
});
