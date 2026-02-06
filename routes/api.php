<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\RoleController;

Route::prefix('admin')->controller(RoleController::class)->group(function () {
    Route::get('roles','index');
    Route::post('roles', 'storeOrUpdate');
});