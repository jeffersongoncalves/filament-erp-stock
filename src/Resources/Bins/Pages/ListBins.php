<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\BinResource;

class ListBins extends ListRecords
{
    protected static string $resource = BinResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
