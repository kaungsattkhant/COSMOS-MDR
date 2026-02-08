<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Item\ItemService;
use App\Services\Admin\ItemCategory\ItemCategoryService;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    private $service;

    public function __construct(ItemCategoryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $users = $this->service->getAll($request->all());
        return UserResource::collection($users);
    }
    public function show(int $userId)
    {
        try {
            $user = $this->service->getDetail($userId);
            return new UserResource($user);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('User not found', 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);
        $user = $this->service->save($request->all());
        return new UserResource($user);
    }
}
