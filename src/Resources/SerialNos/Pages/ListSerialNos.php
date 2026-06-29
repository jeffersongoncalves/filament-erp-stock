<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\SerialNoResource;

class ListSerialNos extends ListRecords
{
    protected static string $resource = SerialNoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
