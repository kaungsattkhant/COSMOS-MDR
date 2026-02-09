<?php

namespace App\Services\Admin\Inventory;

use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function getAllInventory(array $data)
    {
        $query = Inventory::query()->orderBy('id', 'asc')->filter($data);
        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }
        return $query->get();
    }

    public function getInventoryDetail(int $id)
    {
        return Inventory::findOrFail($id);
    }

    public function saveInventory(array $data)
    {
        return DB::transaction(
            function () use ($data) {
                $inventory = Inventory::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );
                return $inventory;
            }
        );
    }
}
