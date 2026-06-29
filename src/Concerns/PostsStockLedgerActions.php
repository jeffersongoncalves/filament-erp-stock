<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Concerns;

use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Erp\Accounting\Support\ModelResolver as AccountingModelResolver;
use JeffersonGoncalves\Erp\Stock\Models\DeliveryNote;
use JeffersonGoncalves\Erp\Stock\Models\PurchaseReceipt;
use JeffersonGoncalves\Erp\Stock\Models\StockEntry;
use JeffersonGoncalves\Erp\Stock\Models\StockReconciliation;
use JeffersonGoncalves\FilamentErp\Core\Concerns\SubmittableRecordActions;

/**
 * Submit / Cancel record actions for documents that post to the perpetual
 * inventory ledger and the general ledger. The submit modal asks for the
 * counter (offset) GL account that absorbs the net change in stock value
 * (e.g. "Stock Received But Not Billed", "Cost of Goods Sold" or a stock
 * adjustment account); it is applied to the transient {@see counterAccountId}
 * property on the domain document before submission.
 */
trait PostsStockLedgerActions
{
    use SubmittableRecordActions;

    /** @return array<int, mixed> */
    protected static function submitActionSchema(): array
    {
        return [
            Select::make('counter_account_id')
                ->label('Counter Account')
                ->helperText('The offsetting GL account for the net change in stock value.')
                ->options(fn (): array => AccountingModelResolver::account()::query()
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->all())
                ->searchable()
                ->required(),
        ];
    }

    /**
     * Apply the chosen counter account to the transient property the domain
     * document reads when posting the offsetting general-ledger entry. The
     * property is declared on each concrete ledger-posting model, so we narrow
     * to those types before writing it.
     *
     * @param  array<string, mixed>  $data
     */
    protected static function beforeSubmit(Model $record, array $data): void
    {
        $counterAccountId = isset($data['counter_account_id'])
            ? (int) $data['counter_account_id']
            : null;

        if (
            $record instanceof StockEntry
            || $record instanceof DeliveryNote
            || $record instanceof PurchaseReceipt
            || $record instanceof StockReconciliation
        ) {
            $record->counterAccountId = $counterAccountId;
        }
    }
}
