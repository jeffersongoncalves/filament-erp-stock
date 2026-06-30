<?php

namespace JeffersonGoncalves\FilamentErp\Stock\Tests\Fixtures;

use Composer\InstalledVersions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\FilamentErp\Stock\Tests\TestCase;

/**
 * Creates the vendored domain tables for the newer stock features that are not
 * part of the base {@see TestCase}
 * migration list. Loading them here keeps the new resource tests self-contained
 * without modifying the shared base TestCase.
 */
class StockMigrations
{
    /**
     * Idempotently create the given tables from their vendored migration stubs,
     * in the supplied (foreign-key-safe) order.
     *
     * @param  array<string, string>  $tables  map of table name => migration stub basename
     */
    public static function ensure(array $tables): void
    {
        $base = InstalledVersions::getInstallPath('jeffersongoncalves/laravel-erp-stock').'/database/migrations';
        $prefix = config('erp-stock.table_prefix') ?? '';

        foreach ($tables as $table => $stub) {
            if (Schema::hasTable($prefix.$table)) {
                continue;
            }

            $migration = require $base.'/'.$stub.'.php.stub';

            if ($migration instanceof Migration && method_exists($migration, 'up')) {
                $migration->up();
            }
        }
    }

    /**
     * Ensure every table backing the newer stock resources exists.
     */
    public static function ensureAll(): void
    {
        self::ensure([
            'putaway_rules' => 'create_erp_putaway_rules_table',
            'shipments' => 'create_erp_shipments_table',
            'shipment_parcels' => 'create_erp_shipment_parcels_table',
            'shipment_delivery_notes' => 'create_erp_shipment_delivery_notes_table',
            'packing_slips' => 'create_erp_packing_slips_table',
            'packing_slip_items' => 'create_erp_packing_slip_items_table',
        ]);
    }
}
