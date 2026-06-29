<?php

namespace JeffersonGoncalves\FilamentErp\Stock;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentErpStockServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-erp-stock';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
