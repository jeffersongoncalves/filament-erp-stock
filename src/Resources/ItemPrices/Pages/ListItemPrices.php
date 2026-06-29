<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\ItemPrices\ItemPriceResource;

class ListItemPrices extends ListRecords
{
    protected static string $resource = ItemPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
