<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResourceList;
use App\Services\Role\RoleService;

class RoleController extends Controller
{
    private $service;

    public function __construct(RoleService $service)
    {
       $this->service=$service;
    }
    public function index(Request $request)
    {
        $roles=$this->service->getAllRole($request->all());
        return RoleResourceList::collection($roles);
    }

    public function storeOrUpdate(Request $request)
    {
        $role = $this->service->saveRole($request->all());
        \ResponseData(new RoleResourceList($role));
    }

}
