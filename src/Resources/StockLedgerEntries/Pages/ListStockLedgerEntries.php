<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\StockLedgerEntryResource;

class ListStockLedgerEntries extends ListRecords
{
    protected static string $resource = StockLedgerEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
