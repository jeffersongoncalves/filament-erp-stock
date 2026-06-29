<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\SerialNoResource;

class CreateSerialNo extends CreateRecord
{
    protected static string $resource = SerialNoResource::class;
}
