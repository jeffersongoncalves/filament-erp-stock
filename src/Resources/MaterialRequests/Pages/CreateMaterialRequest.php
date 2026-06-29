<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\MaterialRequestResource;

class CreateMaterialRequest extends CreateRecord
{
    protected static string $resource = MaterialRequestResource::class;
}
