<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Item\ItemStoreOrUpdateRequest;
use App\Services\Admin\Item\ItemService;
use App\Http\Resources\Admin\Item\ItemListResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemController extends Controller
{
    public function __construct(
        private ItemService $service,
    ) {}

    public function index(Request $request)
    {
        $items = $this->service->getAllItems($request->all());
        return ItemListResource::collection($items);
    }

    public function show(int $id)
    {
        try {
            $item = $this->service->getItemDetail($id);
            return new ItemListResource($item);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('Data not found', 404);
        }
    }

    public function storeOrUpdate(ItemStoreOrUpdateRequest $request)
    {
        $item = $this->service->saveItem($request->all());
        return new ItemListResource($item);
    }
   
}
