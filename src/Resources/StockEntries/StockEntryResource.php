<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Pages\CreateStockEntry;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Pages\EditStockEntry;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Pages\ListStockEntries;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\RelationManagers\DetailsRelationManager;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Schemas\StockEntryForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockEntries\Tables\StockEntriesTable;

class StockEntryResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'naming_series';

    public static function getModel(): string
    {
        return ModelResolver::stockEntry();
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
        return StockEntryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StockEntriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            DetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStockEntries::route('/'),
            'create' => CreateStockEntry::route('/create'),
            'edit' => EditStockEntry::route('/{record}/edit'),
        ];
    }
}
