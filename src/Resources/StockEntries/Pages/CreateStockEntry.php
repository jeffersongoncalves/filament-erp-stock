<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\StockEntryResource;

class CreateStockEntry extends CreateRecord
{
    protected static string $resource = StockEntryResource::class;
}
