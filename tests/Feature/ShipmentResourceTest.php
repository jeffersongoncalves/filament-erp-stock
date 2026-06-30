<?php

use Filament\Actions\Testing\TestAction;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\Erp\Stock\Models\Shipment;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\Pages\CreateShipment;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\Pages\ListShipments;
use JeffersonGoncalves\FilamentErp\Stock\Tests\Fixtures\StockMigrations;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    StockMigrations::ensureAll();

    $this->company = Company::factory()->create();
});

it('can render the shipment list page', function () {
    Livewire::test(ListShipments::class)->assertSuccessful();
});

it('can render the shipment create page', function () {
    Livewire::test(CreateShipment::class)->assertSuccessful();
});

it('can create a shipment', function () {
    Livewire::test(CreateShipment::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'shipment_date' => now(),
            'pickup_from_type' => 'Company',
            'delivery_to_type' => 'Customer',
            'value_of_goods' => 500,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Shipment::query()
        ->where('company_id', $this->company->id)
        ->where('value_of_goods', 500)
        ->exists())->toBeTrue();
});

it('submits a shipment through the UI, flipping the docstatus', function () {
    $shipment = Shipment::factory()->create([
        'company_id' => $this->company->id,
    ]);

    expect($shipment->docstatus)->toBe(DocStatus::Draft);

    Livewire::test(ListShipments::class)
        ->callAction(TestAction::make('submit')->table($shipment));

    expect($shipment->refresh()->docstatus)->toBe(DocStatus::Submitted);
});

it('cancels a submitted shipment through the UI, flipping the docstatus', function () {
    $shipment = Shipment::factory()->create([
        'company_id' => $this->company->id,
    ]);

    Livewire::test(ListShipments::class)
        ->callAction(TestAction::make('submit')->table($shipment));

    expect($shipment->refresh()->docstatus)->toBe(DocStatus::Submitted);

    Livewire::test(ListShipments::class)
        ->callAction(TestAction::make('cancel')->table($shipment));

    expect($shipment->refresh()->docstatus)->toBe(DocStatus::Cancelled);
});
