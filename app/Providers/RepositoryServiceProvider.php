<?php

namespace App\Providers;

use App\Models\PurchaseOrder;
use App\Repositories\Uom\UomInterface;
use App\Repositories\Uom\UomRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Bank\BankInterface;
use App\Repositories\Item\ItemInterface;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Bank\BankRepository;
use App\Repositories\Item\ItemRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Customer\CustomerInterface;
use App\Repositories\Supplier\SupplierInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\InventoryLedger\InventoryLedgerInterface;
use App\Repositories\InventoryLedger\InventoryLedgerRepository;
use App\Repositories\PurchaseOrder\PurchaseOrderInterface;
use App\Repositories\PurchaseOrder\PurchaseOrderRepository;
use App\Repositories\InventoryLedgerItem\InventoryLedgerItemInterface;
use App\Repositories\InventoryLedgerItem\InventoryLedgerItemRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(ItemInterface::class, ItemRepository::class);
        $this->app->bind(SupplierInterface::class, SupplierRepository::class);
        $this->app->bind(UomInterface::class, UomRepository::class);
        $this->app->bind(BankInterface::class, BankRepository::class);
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
        $this->app->bind(BankInterface::class, BankRepository::class);
        $this->app->bind(PurchaseOrderInterface::class, PurchaseOrderRepository::class);
        $this->app->bind(InventoryLedgerInterface::class, InventoryLedgerRepository::class);
    }
}
