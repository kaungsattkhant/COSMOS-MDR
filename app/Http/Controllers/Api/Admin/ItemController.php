<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Item\ItemService;
use App\Http\Resources\Admin\Item\ItemListResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Admin\Item\ItemStoreOrUpdateRequest;
use App\Http\Resources\Admin\Item\ItemSupplierPriceListResource;

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

    public function storeItemSupplierPrice(Request $request)
    {
        $itemSupplierPrice= $this->service->storeItemSupplierPrice($request->all());
        return new ItemSupplierPriceListResource($itemSupplierPrice);
    }

    public function getItemSupplierPrice(int $id)
    {
        $itemSupplier= $this->service->getItemSupplierPrice($id);
        return ItemSupplierPriceListResource::collection($itemSupplier);
    }

    public function getItemBySupplier(int $supplierId)
    {
        $items= $this->service->getItemBySupplier($supplierId);
        return  ItemSupplierPriceListResource::collection($items);
    }
   
}
