<?php

namespace App\Repositories\PurchaseOrder;

use App\Enums\GrnStatusEnum;
use App\Models\GrnItem;
use App\Models\PurchaseOrder;

class PurchaseOrderRepository implements PurchaseOrderInterface
{
    public function all(array $data)
    {
        $query = PurchaseOrder::query()->with(['supplier', 'purchase_order_items.item'])->orderBy('id', 'desc')
        ->filter($data);

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

    public function partialReceived(array $data)
    {
        return GrnItem::create($data);
    }

    public function getPartialReceive(array $data)
    {
        $query = GrnItem::query()->with(['purchase_order_item', 'purchase_order_item.purchase_order', 'purchase_order_item.item'])
        ->where('status',GrnStatusEnum::CONFIRMED->value);
        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }

        return $query->get();
    }

    public function updatePartialReceiveStatus(array $data)
    {
        return GrnItem::where('id', $data['id'])->update([
            'status' => $data['status'],
            'received_by' => auth()->user()->id,
            'received_at' => now(),
            ]);
    }

}