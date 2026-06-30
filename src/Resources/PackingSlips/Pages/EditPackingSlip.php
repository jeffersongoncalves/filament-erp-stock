<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\PackingSlipResource;

class EditPackingSlip extends EditRecord
{
    protected static string $resource = PackingSlipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
