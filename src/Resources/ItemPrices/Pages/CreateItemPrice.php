<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\ItemPriceResource;

class CreateItemPrice extends CreateRecord
{
    protected static string $resource = ItemPriceResource::class;
}
