<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Resources\MaterialRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MaterialRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        Select::make('material_request_type')
                            ->label('Material Request Type')
                            ->options(self::typeOptions())
                            ->default('Purchase')
                            ->required(),
                        DatePicker::make('transaction_date')
                            ->label('Transaction Date')
                            ->required()
                            ->default(now()),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('status')
                            ->label('Status')
                            ->options(self::statusOptions())
                            ->default('Draft'),
                    ])->columns(2),
            ]);
    }

    /** @return array<string, string> */
    protected static function typeOptions(): array
    {
        return [
            'Purchase' => 'Purchase',
            'Material Transfer' => 'Material Transfer',
            'Material Issue' => 'Material Issue',
            'Manufacture' => 'Manufacture',
            'Customer Provided' => 'Customer Provided',
        ];
    }

    /** @return array<string, string> */
    protected static function statusOptions(): array
    {
        return [
            'Draft' => 'Draft',
            'Pending' => 'Pending',
            'Ordered' => 'Ordered',
            'Received' => 'Received',
            'Cancelled' => 'Cancelled',
        ];
    }
}
