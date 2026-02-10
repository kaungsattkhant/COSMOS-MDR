<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Item\ItemService;
use App\Services\Admin\ItemCategory\ItemCategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Admin\ItemCategory\ItemCategoryListResource;

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
        return ItemCategoryListResource::collection($users);
    }
    public function show(int $userId)
    {
        try {
            $user = $this->service->getDetail($userId);
            return new ItemCategoryListResource($user);
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
        return new ItemCategoryListResource($user);
    }

    
}
