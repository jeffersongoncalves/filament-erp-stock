<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\PutawayRuleResource;

class ListPutawayRules extends ListRecords
{
    protected static string $resource = PutawayRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
