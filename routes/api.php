<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\CommonController;
use App\Http\Controllers\Api\Admin\PermissionController;

//auth

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'storeOrUpdate');
    });
    Route::prefix('roles')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'storeOrUpdate');
    });
    Route::prefix('/')->controller(CommonController::class)->group(function () {
        Route::post('/toggle_is_active', 'toggleIsActive');
    });
    Route::prefix('/')->controller(PermissionController::class)->group(function () {
        Route::get('/permissions', 'index');
    });
});
