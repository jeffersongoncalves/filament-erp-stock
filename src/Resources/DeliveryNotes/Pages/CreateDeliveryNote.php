<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\DeliveryNoteResource;

class CreateDeliveryNote extends CreateRecord
{
    protected static string $resource = DeliveryNoteResource::class;
}
