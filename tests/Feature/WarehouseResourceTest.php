<?php

use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\Erp\Stock\Models\Warehouse;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Pages\CreateWarehouse;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Pages\EditWarehouse;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Warehouses\Pages\ListWarehouses;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the warehouse list page', function () {
    Livewire::test(ListWarehouses::class)->assertSuccessful();
});

it('can list warehouses in the table', function () {
    $warehouse = Warehouse::factory()->create();

    Livewire::test(ListWarehouses::class)
        ->assertCanSeeTableRecords([$warehouse]);
});

it('can render the warehouse create page', function () {
    Livewire::test(CreateWarehouse::class)->assertSuccessful();
});

it('can create a warehouse', function () {
    $company = Company::factory()->create();

    Livewire::test(CreateWarehouse::class)
        ->fillForm([
            'name' => 'Main Store',
            'company_id' => $company->id,
            'is_group' => false,
            'disabled' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Warehouse::query()->where('name', 'Main Store')->exists())->toBeTrue();
});

it('can render the warehouse edit page', function () {
    $warehouse = Warehouse::factory()->create();

    Livewire::test(EditWarehouse::class, ['record' => $warehouse->getRouteKey()])
        ->assertSuccessful();
});
