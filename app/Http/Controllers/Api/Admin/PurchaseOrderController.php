<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PurchaseOrder\PurchaseOrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Admin\PurchaseOrder\PurchaseOrderListResource;
use App\Http\Requests\Admin\PurchaseOrder\PurchaseOrderStoreOrUpdateRequest;
use App\Http\Resources\Admin\PurchaseOrder\PartialReceiveResourceList;

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
        return $id;
        // try {
        //     $purchaseOrder = $this->service->getPurchaseOrderDetail($id);
        //     return new PurchaseOrderListResource($purchaseOrder);
        // } catch (ModelNotFoundException $e) {
        //     return ResponseMessage('Data not found', 404);
        // }
    }

    public function storeOrUpdate(PurchaseOrderStoreOrUpdateRequest $request)
    {
        $purchaseOrder = $this->service->savePurchaseOrder($request->all());
        return new PurchaseOrderListResource($purchaseOrder);
    }

    public function partialReceived(Request $request)
    {
        $request->validate([
            'purchase_order_item_id' => 'required|exists:purchase_order_items,id',
            'qty_received' => 'required|numeric|min:0',
        ]);
        $partialReceived = $this->service->partialReceived($request->all());
        return ResponseMessage('Partial received successfully', 201, $partialReceived);
    }

    public function getPartialReceive(Request $request)
    {
        $partialReceives = $this->service->getPartialReceive($request->all());
        return PartialReceiveResourceList::collection($partialReceives);
    }

    public function updatePartialReceiveStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:grn_items,id',
            'status' => 'required|in:confirmed,cancelled',
        ]);

        $updatedGrnItem = $this->service->updatePartialReceiveStatus($request->all());

        return ResponseMessage(
            'Partial receive status updated successfully',
            200,
            $updatedGrnItem);
    }
}
