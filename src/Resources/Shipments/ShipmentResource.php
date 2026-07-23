<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\Pages\CreateShipment;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\Pages\EditShipment;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\Pages\ListShipments;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\RelationManagers\DeliveryNotesRelationManager;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\RelationManagers\ParcelsRelationManager;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\Schemas\ShipmentForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\Tables\ShipmentsTable;

class ShipmentResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 15;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getModel(): string
    {
        return ModelResolver::shipment();
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
        return ShipmentForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ShipmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ParcelsRelationManager::class,
            DeliveryNotesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShipments::route('/'),
            'create' => CreateShipment::route('/create'),
            'edit' => EditShipment::route('/{record}/edit'),
        ];
    }
}
