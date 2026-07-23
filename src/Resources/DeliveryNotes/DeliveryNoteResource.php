<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\Pages\CreateDeliveryNote;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\Pages\EditDeliveryNote;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\Pages\ListDeliveryNotes;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\RelationManagers\ItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\Schemas\DeliveryNoteForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\DeliveryNotes\Tables\DeliveryNotesTable;

class DeliveryNoteResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 9;

    protected static ?string $recordTitleAttribute = 'customer_name';

    public static function getModel(): string
    {
        return ModelResolver::deliveryNote();
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
        return DeliveryNoteForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return DeliveryNotesTable::configure($table);
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
            'index' => ListDeliveryNotes::route('/'),
            'create' => CreateDeliveryNote::route('/create'),
            'edit' => EditDeliveryNote::route('/{record}/edit'),
        ];
    }
}
