<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DeliveryNotesRelationManager extends RelationManager
{
    protected static string $relationship = 'deliveryNotes';

    protected static ?string $title = 'Delivery Notes';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Select::make('delivery_note_id')
                    ->label('Delivery Note')
                    ->relationship('deliveryNote', 'customer_name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('delivery_note_id')
            ->columns([
                TextColumn::make('deliveryNote.customer_name')
                    ->label('Delivery Note')
                    ->searchable(),
                TextColumn::make('deliveryNote.posting_date')
                    ->label('Posting Date')
                    ->dateTime()
                    ->toggleable(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
