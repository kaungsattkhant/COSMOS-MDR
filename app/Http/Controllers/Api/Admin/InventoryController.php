<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Inventory\InventoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Admin\Inventory\InventoryListResource;

class InventoryController extends Controller
{
    //
    private $service;

    public function __construct(InventoryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $users = $this->service->getAllInventory($request->all());
        return InventoryListResource::collection($users);
    }
    public function show(int $userId)
    {
        try {
            $user = $this->service->getInventoryDetail($userId);
            return new InventoryListResource($user);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('User not found', 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);
        $user = $this->service->saveInventory($request->all());
        return new InventoryListResource($user);
    }
}
