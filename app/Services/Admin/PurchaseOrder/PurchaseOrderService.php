<?php

namespace App\Services\Admin\PurchaseOrder;

use App\Enums\PurchaseOrderStatusEnum;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Repositories\PurchaseOrder\PurchaseOrderInterface;
use Illuminate\Support\Facades\DB;

class PurchaseOrderService
{
    protected $repo;

    public function __construct(PurchaseOrderInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAllPurchaseOrders(array $data)
    {
        return $this->repo->all($data);
    }

    public function getPurchaseOrderDetail(int $id)
    {
        return $this->repo->findById($id);
    }

    private function generatePoNo(): string
    {
        $prefix = 'PO';
        $date   = now()->format('Ymd');

        $lastPo = PurchaseOrder::whereDate('created_at', now())
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastPo) {
            $number = 1;
        } else {
            $lastNumber = intval(substr($lastPo->po_no, -4)); // PO20260210-0001
            $number = $lastNumber + 1;
        }

        return "{$prefix}-{$date}-" . str_pad($number, 4, '0', STR_PAD_LEFT);
    }


    public function savePurchaseOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            // $totalAmount = 0;
            // foreach ($data['purchase_order_items'] as $item) {
            //     $totalAmount += $item['qty'] * $item['price'];
            // }

            $purchaseOrder = $this->repo->updateOrCreate(
                ['id' => $data['id'] ?? null],
                [
                    'po_no' => $this->generatePoNo(),
                    'supplier_id'   => $data['supplier_id'],
                    'po_date' => $data['po_date'],
                    'po_invoice_no'  => $data['po_invoice_no'] ?? null,
                    'status'        => $data['status'] ?? PurchaseOrderStatusEnum::DRAFT->value,
                    'remark'         => $data['remark'] ?? null,
                    'total_amount'  => $data['total_amount'],
                    'paid_amount'  => $data['paid_amount'],
                ]
            );
            $purchaseOrder->purchase_order_items()->delete();

            foreach ($data['purchase_order_items'] as $itemData) {
                $purchaseOrder->purchase_order_items()->create([
                    'item_id'        => $itemData['item_id'],
                    'qty'       => $itemData['qty'],
                    'price' => $itemData['price'],
                    'sub_total'      => $itemData['qty'] * $itemData['price'],
                ]);
            }
            return $purchaseOrder->load(['supplier', 'purchase_order_items.item']);
        });
    }

    public function partialReceived(array $data)
    {
        return DB::transaction(
            function () use ($data) {
                $purchaseOrderItem = PurchaseOrderItem::findOrFail($data['purchase_order_item_id']);
                if (!$purchaseOrderItem) {
                    return ResponseMessage('Purchase order item not found', 404);
                }
                if ($data['qty_received'] > ($purchaseOrderItem->qty - $purchaseOrderItem->grn_items()->sum('qty_received'))) {
                    return ResponseMessage('Received quantity exceeds ordered quantity', 400);
                }
                $data['purchase_order_id'] = $purchaseOrderItem->purchase_order_id;
                $data['supplier_id'] = $purchaseOrderItem->purchase_order->supplier_id;
                $data['item_id'] = $purchaseOrderItem->item_id;
                $data['date_time'] = now();
                $data['qty_received'] = $data['qty_received'];
                $data['received_by'] = auth()->user()->id;
                $data['received_at'] = now();
                $purchaseOrder = $this->repo->partialReceived($data);
                return $purchaseOrder;
            }
        );
    }
    public function getPartialReceive(array $data)
    {
        return $this->repo->getPartialReceive($data);
    }

    public function updatePartialReceiveStatus(array $data)
    {
        return $this->repo->updatePartialReceiveStatus($data);
    }
}
