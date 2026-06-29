<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\StockReconciliationResource;

class ListStockReconciliations extends ListRecords
{
    protected static string $resource = StockReconciliationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
