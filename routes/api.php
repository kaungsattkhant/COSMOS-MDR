<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\ItemController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\CommonController;
use App\Http\Controllers\Api\Admin\SupplierController;
use App\Http\Controllers\Api\Admin\PermissionController;
use App\Http\Controllers\Api\Admin\ItemCategoryController;
use App\Http\Controllers\Api\Admin\UomController;

//auth

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    //common
    Route::prefix('/')->controller(CommonController::class)->group(function () {
        Route::post('/toggle_is_active', 'toggleIsActive');
    });
    //users
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'storeOrUpdate');
    });
    //roles
    Route::prefix('roles')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'storeOrUpdate');
    });
    //permission
    Route::prefix('/')->controller(PermissionController::class)->group(function () {
        Route::get('/permissions', 'index');
    });

    //item_category
    Route::prefix('item_categories')->controller(ItemCategoryController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'storeOrUpdate');
    });
    //bank (within SupplierController)
    Route::prefix('banks')->controller(SupplierController::class)->group(function () {
        Route::get('/', 'bankIndex');
        Route::get('{id}', 'bankShow');
        Route::post('/', 'bankStoreOrUpdate');
    });
    //supplier
    Route::prefix('suppliers')->controller(SupplierController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'storeOrUpdate');
    });
    //item
    Route::prefix('items')->controller(ItemController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'storeOrUpdate');
    });
    //uom
    Route::prefix('uoms')->controller(ItemController::class)->group(function () {
        Route::get('/', 'uomIndex');
        Route::get('{id}', 'uomShow');
        Route::post('/', 'uomStoreOrUpdate');
    });
});
