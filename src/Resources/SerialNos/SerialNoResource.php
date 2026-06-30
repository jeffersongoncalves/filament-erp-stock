<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Stock\FilamentErpStockPlugin;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Pages\CreateSerialNo;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Pages\EditSerialNo;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Pages\ListSerialNos;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Schemas\SerialNoForm;
use JeffersonGoncalves\FilamentErp\Stock\Resources\SerialNos\Tables\SerialNosTable;

class SerialNoResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'serial_no';

    public static function getModel(): string
    {
        return ModelResolver::serialNo();
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
        return SerialNoForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return SerialNosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSerialNos::route('/'),
            'create' => CreateSerialNo::route('/create'),
            'edit' => EditSerialNo::route('/{record}/edit'),
        ];
    }
}
