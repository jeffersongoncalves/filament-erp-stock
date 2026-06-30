<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\PackingSlipResource;

class CreatePackingSlip extends CreateRecord
{
    protected static string $resource = PackingSlipResource::class;
}
