<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\StockEntryResource;

class EditStockEntry extends EditRecord
{
    protected static string $resource = StockEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
