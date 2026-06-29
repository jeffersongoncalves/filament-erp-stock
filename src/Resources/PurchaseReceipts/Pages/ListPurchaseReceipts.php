<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\PurchaseReceiptResource;

class ListPurchaseReceipts extends ListRecords
{
    protected static string $resource = PurchaseReceiptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
