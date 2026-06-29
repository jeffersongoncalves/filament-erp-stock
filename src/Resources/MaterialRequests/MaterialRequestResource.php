<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Pages\CreateMaterialRequest;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Pages\EditMaterialRequest;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Pages\ListMaterialRequests;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\RelationManagers\ItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Schemas\MaterialRequestForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Tables\MaterialRequestsTable;

class MaterialRequestResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?int $navigationSort = 8;

    protected static ?string $recordTitleAttribute = 'naming_series';

    public static function getModel(): string
    {
        return ModelResolver::materialRequest();
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
        return MaterialRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaterialRequestsTable::configure($table);
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
            'index' => ListMaterialRequests::route('/'),
            'create' => CreateMaterialRequest::route('/create'),
            'edit' => EditMaterialRequest::route('/{record}/edit'),
        ];
    }
}
