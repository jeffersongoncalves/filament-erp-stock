<?php

use JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\BinResource;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\Pages\ListBins;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the stock balance (bin) list page', function () {
    Livewire::test(ListBins::class)->assertSuccessful();
});

it('is a read-only resource without create or edit capability', function () {
    expect(BinResource::canCreate())->toBeFalse()
        ->and(BinResource::getPages())->toHaveKeys(['index'])
        ->and(BinResource::getPages())->not->toHaveKey('create');
});
