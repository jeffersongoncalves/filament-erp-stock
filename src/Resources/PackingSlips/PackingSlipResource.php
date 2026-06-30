<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Pages\CreatePackingSlip;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Pages\EditPackingSlip;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Pages\ListPackingSlips;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\RelationManagers\ItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Schemas\PackingSlipForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\PackingSlips\Tables\PackingSlipsTable;

class PackingSlipResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?int $navigationSort = 16;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getModel(): string
    {
        return ModelResolver::packingSlip();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpStockPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-stock.navigation_group', 'ERP — Stock');
        }
    }

    public static function form(Form $form): Form
    {
        return PackingSlipForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return PackingSlipsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPackingSlips::route('/'),
            'create' => CreatePackingSlip::route('/create'),
            'edit' => EditPackingSlip::route('/{record}/edit'),
        ];
    }
}
