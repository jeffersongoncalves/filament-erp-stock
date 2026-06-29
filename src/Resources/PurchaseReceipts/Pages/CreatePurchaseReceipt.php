<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PurchaseReceipts\PurchaseReceiptResource;

class CreatePurchaseReceipt extends CreateRecord
{
    protected static string $resource = PurchaseReceiptResource::class;
}
