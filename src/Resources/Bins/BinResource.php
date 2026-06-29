<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Bins;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\Pages\ListBins;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Bins\Tables\BinsTable;

/**
 * Read-only viewer over the live, per (item, warehouse) stock balance. Bins are
 * maintained by the perpetual inventory engine; they are never created or
 * edited here.
 */
class BinResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static ?int $navigationSort = 13;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $modelLabel = 'Bin';

    protected static ?string $pluralModelLabel = 'Stock Balance';

    public static function getModel(): string
    {
        return ModelResolver::bin();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpStockPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-stock.navigation_group', 'ERP — Stock');
        }
    }

    public static function table(Table $table): Table
    {
        return BinsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBins::route('/'),
        ];
    }
}
