<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Role\RoleService;
use App\Http\Resources\Admin\Role\RoleResourceList;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleController extends Controller
{
    private $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request)
    {
        $roles = $this->service->getAllRole($request->all());
        return RoleResourceList::collection($roles);
    }
    public function show(int $roleId)
    {
        try {
            $role = $this->service->getRoleDetail($roleId);
            return new RoleResourceList($role);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('Data not found', 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $role = $this->service->saveRole($request->all());
        return new RoleResourceList($role);
    }
}
