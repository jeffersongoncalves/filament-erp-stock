<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\MaterialRequestResource;

class EditMaterialRequest extends EditRecord
{
    protected static string $resource = MaterialRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
