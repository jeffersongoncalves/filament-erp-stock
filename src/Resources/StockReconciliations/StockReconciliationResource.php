<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\Pages\CreateStockReconciliation;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\Pages\EditStockReconciliation;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\Pages\ListStockReconciliations;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\RelationManagers\ItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\Schemas\StockReconciliationForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockReconciliations\Tables\StockReconciliationsTable;

class StockReconciliationResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'naming_series';

    public static function getModel(): string
    {
        return ModelResolver::stockReconciliation();
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
        return StockReconciliationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return StockReconciliationsTable::configure($table);
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
            'index' => ListStockReconciliations::route('/'),
            'create' => CreateStockReconciliation::route('/create'),
            'edit' => EditStockReconciliation::route('/{record}/edit'),
        ];
    }
}
