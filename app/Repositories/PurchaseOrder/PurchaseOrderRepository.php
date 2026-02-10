<?php

namespace App\Repositories\PurchaseOrder;

use App\Models\PurchaseOrder;

class PurchaseOrderRepository implements PurchaseOrderInterface
{
    public function all(array $data)
    {
        $query = PurchaseOrder::query()->with(['supplier', 'purchase_order_items.item'])->orderBy('id', 'desc')->filter($data);

        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }

        return $query->get();
    }

    public function findById(int $id)
    {
        return PurchaseOrder::with(['supplier', 'purchase_order_items.item'])->findOrFail($id);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return PurchaseOrder::updateOrCreate($attributes, $values);
    }
}