<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Relation::enforceMorphMap(
            [
                'user' => 'App\Models\User',
                'role' => 'App\Models\Role',
                'uom'=> 'App\Models\Uom',
                'customer'=> 'App\Models\Customer',
                'supplier'=> 'App\Models\Supplier',
                'bank'=> 'App\Models\Bank',
                'item_category'=> 'App\Models\ItemCategory',
                'item'=> 'App\Models\Item',
                'purchase_order'=>'App\Models\PurchaseOrder',
                'inventory'=> 'App\Models\Inventory',
                'inventory_ledger'=> 'App\Models\InventoryLedger',
                'inventory_ledger_item'=> 'App\Models\InventoryLedgerItem',
                'item_supplier_price'=> 'App\Models\ItemSupplierPrice',
                'grn'=> 'App\Models\Grn',
                'grn_item'=> 'App\Models\GrnItem',
                'purchase_order_item'=> 'App\Models\PurchaseOrderItem',
            ]);
    }
}
