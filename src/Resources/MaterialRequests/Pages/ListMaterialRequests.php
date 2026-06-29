<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\MaterialRequestResource;

class ListMaterialRequests extends ListRecords
{
    protected static string $resource = MaterialRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
