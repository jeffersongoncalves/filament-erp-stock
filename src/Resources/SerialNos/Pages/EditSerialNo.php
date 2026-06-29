<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\SerialNoResource;

class EditSerialNo extends EditRecord
{
    protected static string $resource = SerialNoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
