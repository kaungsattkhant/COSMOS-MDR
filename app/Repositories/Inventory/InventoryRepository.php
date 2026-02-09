<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory;

class InventoryRepository implements InventoryInterface
{
    public function all(array $data)
    {
        $query = Inventory::query()->orderBy('id', 'asc')->filter($data);

        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }

        return $query->get();
    }

    public function findById(int $id)
    {
        return Inventory::findOrFail($id);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return Inventory::updateOrCreate($attributes, $values);
    }
}
