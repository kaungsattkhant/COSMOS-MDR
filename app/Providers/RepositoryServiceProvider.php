<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Item\ItemRepository;
use App\Repositories\Item\ItemInterface;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierInterface;

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
    }
}
