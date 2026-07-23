<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries;

use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\Pages\ListStockLedgerEntries;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\Pages\ViewStockLedgerEntry;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\Schemas\StockLedgerEntryInfolist;
use JeffersonGoncalves\FilamentErp\Stock\Resources\StockLedgerEntries\Tables\StockLedgerEntriesTable;

/**
 * Read-only viewer over the immutable perpetual-inventory ledger. Rows are
 * written by the domain lifecycle (submit/cancel); they are never created or
 * edited here.
 */
class StockLedgerEntryResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 12;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $modelLabel = 'Stock Ledger Entry';

    protected static ?string $pluralModelLabel = 'Stock Ledger';

    public static function getModel(): string
    {
        return ModelResolver::stockLedgerEntry();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpStockPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-stock.navigation_group', 'ERP — Stock');
        }
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return StockLedgerEntryInfolist::configure($infolist);
    }

    public static function table(Table $table): Table
    {
        return StockLedgerEntriesTable::configure($table);
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
            'index' => ListStockLedgerEntries::route('/'),
            'view' => ViewStockLedgerEntry::route('/{record}'),
        ];
    }
}
