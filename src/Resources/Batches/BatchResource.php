<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Batches;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\Pages\CreateBatch;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\Pages\EditBatch;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\Pages\ListBatches;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\Schemas\BatchForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Batches\Tables\BatchesTable;

class BatchResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'batch_id';

    public static function getModel(): string
    {
        return ModelResolver::batch();
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
        return BatchForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BatchesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBatches::route('/'),
            'create' => CreateBatch::route('/create'),
            'edit' => EditBatch::route('/{record}/edit'),
        ];
    }
}
