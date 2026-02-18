<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\UomController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\BankController;
use App\Http\Controllers\Api\Admin\ItemController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\CommonController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\SupplierController;
use App\Http\Controllers\Api\Admin\InventoryController;
use App\Http\Controllers\Api\Admin\PermissionController;
use App\Http\Controllers\Api\Admin\ItemCategoryController;
use App\Http\Controllers\Api\Admin\PurchaseOrderController;
use App\Http\Controllers\Api\Admin\InventoryLedgerController;
//auth

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    //common
    Route::middleware('auth:sanctum')->group(function () {

        //logout
        Route::post('/logout', [AuthController::class, 'logout']);

        //toggle
        Route::prefix('/')->controller(CommonController::class)->group(function () {
            Route::post('/toggle_is_active', 'toggleIsActive');
        });
        //users
        Route::prefix('users')->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:user.list');
            Route::get('{id}', 'show')->middleware('permission:user.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:user.create');
        });

        Route::prefix('roles')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:role.list');
            Route::get('{id}', 'show')->middleware('permission:role.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:role.create');
        });

        Route::get('/permissions', [PermissionController::class, 'index'])
            ->middleware('permission:permission.list');

        Route::prefix('item_categories')->controller(ItemCategoryController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:item_category.list');
            Route::get('{id}', 'show')->middleware('permission:item_category.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:item_category.create');
        });

        Route::prefix('banks')->controller(BankController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:bank.list');
            Route::get('{id}', 'show')->middleware('permission:bank.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:bank.create');
        });

        Route::prefix('suppliers')->controller(SupplierController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:supplier.list');
            Route::get('{id}', 'show')->middleware('permission:supplier.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:supplier.create');
        });

        Route::prefix('items')->controller(ItemController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:item.list');
            Route::get('{id}', 'show')->middleware('permission:item.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:item.create');
            Route::get('{itemId}/item_supplier_prices', 'getItemSupplierPrice')->middleware('permission:item.item-supplier-price-list');
            Route::post('item_supplier_prices', 'storeItemSupplierPrice')->middleware('permission:item.item-supplier-price-create');
            Route::get('item_by_supplier/{supplierId}', 'getItemBySupplier')->middleware('permission:item.create');
        });

        Route::prefix('uoms')->controller(UomController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:uom.list');
            Route::get('{id}', 'show')->middleware('permission:uom.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:uom.create');
        });

        Route::prefix('inventories')->controller(InventoryController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:inventory.list');
            Route::get('{id}', 'show')->middleware('permission:inventory.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:inventory.create');
        });

        Route::prefix('customers')->controller(CustomerController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:customer.list');
            Route::get('{id}', 'show')->middleware('permission:customer.detail');
            Route::post('/', 'storeOrUpdate')->middleware('permission:customer.create');
        });

        Route::prefix('purchase_orders')->controller(PurchaseOrderController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:purchase_order.list');
            Route::post('/', 'storeOrUpdate')->middleware('permission:purchase_order.create');
            Route::post('/partial_receives', 'partialReceived');
            // ->middleware('permission:purchase_order.partial_received');
            Route::get('/partial_receives', 'getPartialReceive');
            Route::post('/partial_receives/update_status', 'updatePartialReceiveStatus');
            Route::get('{id}', 'show')->middleware('permission:purchase_order.detail');
        });

        Route::prefix('inventory_ledgers')->controller(InventoryLedgerController::class)->group(function () {
            Route::get('/', 'index')->middleware('permission:inventory_ledger.list');
            Route::get('{id}', 'show')->middleware('permission:inventory_ledger.detail');
        });
    });
});
