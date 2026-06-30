<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\PutawayRuleResource;

class EditPutawayRule extends EditRecord
{
    protected static string $resource = PutawayRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
