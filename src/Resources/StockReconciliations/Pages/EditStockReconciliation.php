<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\StockReconciliationResource;

class EditStockReconciliation extends EditRecord
{
    protected static string $resource = StockReconciliationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
