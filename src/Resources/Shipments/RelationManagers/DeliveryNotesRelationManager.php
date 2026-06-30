<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DeliveryNotesRelationManager extends RelationManager
{
    protected static string $relationship = 'deliveryNotes';

    protected static ?string $title = 'Delivery Notes';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
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
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
