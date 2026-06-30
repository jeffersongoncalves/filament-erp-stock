<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\Shipments\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ParcelsRelationManager extends RelationManager
{
    protected static string $relationship = 'parcels';

    protected static ?string $title = 'Parcels';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('length')
                    ->label('Length')
                    ->numeric()
                    ->default(0),
                TextInput::make('width')
                    ->label('Width')
                    ->numeric()
                    ->default(0),
                TextInput::make('height')
                    ->label('Height')
                    ->numeric()
                    ->default(0),
                TextInput::make('weight')
                    ->label('Weight')
                    ->numeric()
                    ->default(0),
                TextInput::make('count')
                    ->label('Count')
                    ->numeric()
                    ->default(1),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('length')
                    ->numeric(),
                TextColumn::make('width')
                    ->numeric(),
                TextColumn::make('height')
                    ->numeric(),
                TextColumn::make('weight')
                    ->numeric(),
                TextColumn::make('count')
                    ->numeric(),
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
