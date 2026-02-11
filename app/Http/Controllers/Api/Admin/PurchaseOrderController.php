<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PurchaseOrder\PurchaseOrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Admin\PurchaseOrder\PurchaseOrderListResource;
use App\Http\Requests\Admin\PurchaseOrder\PurchaseOrderStoreOrUpdateRequest;

class PurchaseOrderController extends Controller
{
    public function __construct(
        private PurchaseOrderService $service,
    ) {}

    public function index(Request $request)
    {
        $purchaseOrders = $this->service->getAllPurchaseOrders($request->all());
        return PurchaseOrderListResource::collection($purchaseOrders);
    }

    public function show(int $id)
    {
        try {
            $purchaseOrder = $this->service->getPurchaseOrderDetail($id);
            return new PurchaseOrderListResource($purchaseOrder);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('Data not found', 404);
        }
    }

    public function storeOrUpdate(PurchaseOrderStoreOrUpdateRequest $request)
    {
        $purchaseOrder = $this->service->savePurchaseOrder($request->all());
        return new PurchaseOrderListResource($purchaseOrder);
    }
}