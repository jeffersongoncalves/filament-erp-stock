<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Concerns;

use JeffersonGoncalves\FilamentErp\Core\Concerns\HasErpPluginConfig;

trait HasErpStockPluginConfig
{
    use HasErpPluginConfig;

    protected function getConfigKey(): string
    {
        return 'filament-erp-stock';
    }

    protected function getDefaultNavigationGroup(): string
    {
        return 'ERP — Stock';
    }
}
