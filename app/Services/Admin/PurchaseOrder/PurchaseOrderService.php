<?php

namespace App\Services\Admin\PurchaseOrder;

use Illuminate\Support\Facades\DB;
use App\Repositories\PurchaseOrder\PurchaseOrderInterface;

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

    public function savePurchaseOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            $totalAmount = 0;
            foreach ($data['purchase_order_items'] as $item) {
                $totalAmount += $item['quantity'] * $item['purchase_price'];
            }

            $purchaseOrder = $this->repo->updateOrCreate(
                ['id' => $data['id'] ?? null],
                [
                    'supplier_id'   => $data['supplier_id'],
                    'purchase_date' => $data['purchase_date'],
                    'reference_no'  => $data['reference_no'] ?? null,
                    'status'        => $data['status'] ?? 'received',
                    'notes'         => $data['notes'] ?? null,
                    'total_amount'  => $totalAmount,
                ]
            );

            $purchaseOrder->purchase_order_items()->delete();

            foreach ($data['purchase_order_items'] as $itemData) {
                $purchaseOrder->purchase_order_items()->create([
                    'item_id'        => $itemData['item_id'],
                    'quantity'       => $itemData['quantity'],
                    'purchase_price' => $itemData['purchase_price'],
                    'sub_total'      => $itemData['quantity'] * $itemData['purchase_price'],
                ]);
            }

            return $purchaseOrder->load(['supplier', 'purchase_order_items.item']);
        });
    }
}