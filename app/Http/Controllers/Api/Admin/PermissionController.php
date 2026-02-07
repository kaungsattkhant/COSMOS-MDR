<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $permissions = Permission::where('guard_name', 'admin')->get()
            ->groupBy(function ($permission) {
                return explode('.', $permission->name)[0]; // group by 'item', 'user', etc.
        });
        return ResponseMessage('Permission list', 200, [$permissions]);
    }
}
