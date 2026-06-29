<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;

/**
 * The total value of stock on hand across every bin, and how many distinct
 * items currently carry a positive balance.
 */
class StockBalanceWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $binModel = ModelResolver::bin();

        $stockValue = (float) $binModel::query()->sum('stock_value');

        $itemsInStock = $binModel::query()
            ->where('actual_qty', '>', 0)
            ->distinct()
            ->count('item_id');

        $bins = $binModel::query()->count();

        return [
            Stat::make('Stock Value', number_format($stockValue, 2))
                ->description($itemsInStock.' item(s) in stock')
                ->color('primary'),
            Stat::make('Bins', (string) $bins)
                ->description('stock balance records')
                ->color('gray'),
        ];
    }
}
