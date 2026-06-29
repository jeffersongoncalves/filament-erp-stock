<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver;

/**
 * Flags (item, warehouse) bins whose on-hand quantity has fallen to or below
 * the reorder threshold — i.e. stock that needs replenishing. The threshold
 * defaults to zero (out of stock).
 */
class LowStockWidget extends StatsOverviewWidget
{
    protected float $threshold = 0;

    protected function getStats(): array
    {
        $binModel = ModelResolver::bin();

        $count = $binModel::query()
            ->where('actual_qty', '<=', $this->threshold)
            ->count();

        return [
            Stat::make('Low Stock', (string) $count)
                ->description('bin(s) at or below '.$this->threshold)
                ->color($count > 0 ? 'danger' : 'success'),
        ];
    }
}
