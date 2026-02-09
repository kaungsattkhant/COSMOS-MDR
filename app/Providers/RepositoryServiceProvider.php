<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Item\ItemRepository;
use App\Repositories\Item\ItemInterface;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierInterface;
use App\Repositories\Bank\BankInterface;
use App\Repositories\Uom\UomRepository;
use App\Repositories\Uom\UomInterface;
use App\Repositories\Bank\BankRepository;   


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
    }
}
