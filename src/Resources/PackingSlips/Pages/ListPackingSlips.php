<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\PackingSlipResource;

class ListPackingSlips extends ListRecords
{
    protected static string $resource = PackingSlipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
