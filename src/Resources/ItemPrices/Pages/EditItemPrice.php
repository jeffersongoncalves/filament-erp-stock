<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\ItemPriceResource;

class EditItemPrice extends EditRecord
{
    protected static string $resource = ItemPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
