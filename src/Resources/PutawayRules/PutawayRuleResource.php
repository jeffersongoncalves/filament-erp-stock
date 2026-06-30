<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Pages\CreatePutawayRule;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Pages\EditPutawayRule;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Pages\ListPutawayRules;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Schemas\PutawayRuleForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PutawayRules\Tables\PutawayRulesTable;

class PutawayRuleResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static ?int $navigationSort = 14;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getModel(): string
    {
        return ModelResolver::putawayRule();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpStockPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-stock.navigation_group', 'ERP — Stock');
        }
    }

    public static function form(Schema $schema): Schema
    {
        return PutawayRuleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PutawayRulesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPutawayRules::route('/'),
            'create' => CreatePutawayRule::route('/create'),
            'edit' => EditPutawayRule::route('/{record}/edit'),
        ];
    }
}
