<?php

use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Stock\Models\DeliveryNote;
use JeffersonGoncalves\Erp\Stock\Models\PackingSlip;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Pages\CreatePackingSlip;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Pages\ListPackingSlips;
use JeffersonGoncalves\FilamentErp\Stock\Tests\Fixtures\StockMigrations;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    StockMigrations::ensureAll();
});

it('can render the packing slip list page', function () {
    Livewire::test(ListPackingSlips::class)->assertSuccessful();
});

it('can render the packing slip create page', function () {
    Livewire::test(CreatePackingSlip::class)->assertSuccessful();
});

it('can create a packing slip', function () {
    $deliveryNote = DeliveryNote::factory()->create();

    Livewire::test(CreatePackingSlip::class)
        ->fillForm([
            'delivery_note_id' => $deliveryNote->id,
            'from_case_no' => 1,
            'to_case_no' => 3,
            'net_weight' => 12,
            'gross_weight' => 15,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(PackingSlip::query()
        ->where('delivery_note_id', $deliveryNote->id)
        ->where('to_case_no', 3)
        ->exists())->toBeTrue();
});

it('submits a packing slip through the UI, flipping the docstatus', function () {
    $slip = PackingSlip::factory()->create();

    expect($slip->docstatus)->toBe(DocStatus::Draft);

    Livewire::test(ListPackingSlips::class)
        ->callTableAction('submit', $slip);

    expect($slip->refresh()->docstatus)->toBe(DocStatus::Submitted);
});

it('cancels a submitted packing slip through the UI, flipping the docstatus', function () {
    $slip = PackingSlip::factory()->create();

    Livewire::test(ListPackingSlips::class)
        ->callTableAction('submit', $slip);

    expect($slip->refresh()->docstatus)->toBe(DocStatus::Submitted);

    Livewire::test(ListPackingSlips::class)
        ->callTableAction('cancel', $slip);

    expect($slip->refresh()->docstatus)->toBe(DocStatus::Cancelled);
});
