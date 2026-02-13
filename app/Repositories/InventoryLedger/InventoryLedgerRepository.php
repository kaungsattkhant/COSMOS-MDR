<?php

namespace App\Repositories\InventoryLedger;

use App\Models\InventoryLedger;

class InventoryLedgerRepository implements InventoryLedgerInterface
{
    public function all(array $data)
    {
        $query = InventoryLedger::query()
            ->with(['inventory', 'inventory_ledger_items.item'])
            ->orderBy('id', 'desc')
            ->filter($data);

        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }

        return $query->get();
    }

    public function findById(int $id)
    {
        return InventoryLedger::with(['inventory', 'inventory_ledger_items.item'])->findOrFail($id);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return InventoryLedger::updateOrCreate($attributes, $values);
    }
}
