<?php

namespace App\Repositories\Item;

use App\Models\Item;
use App\Models\ItemSupplierPrice;

class ItemRepository implements ItemInterface
{
    public function all(array $data)
    {
        $query = Item::query()->with(['item_category'])->orderBy('id', 'asc')->filter($data);

        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }

        return $query->get();
    }

    public function findById(int $id)
    {
        return Item::findOrFail($id);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return Item::updateOrCreate($attributes, $values);
    }

    public function getItemSupplierPrice(int $itemId) {
        return ItemSupplierPrice::where('item_id', $itemId)->with(['supplier','item'])->orderBy('id', 'asc')->get();
    }

    public function saveItemSupplierPrice(Item $item, array $values) {
        return $item->supplier_prices()->updateOrCreate(['id' => $values['id'] ?? null], $values);
    }
}
