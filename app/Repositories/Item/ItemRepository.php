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
        $latest = ItemSupplierPrice::selectRaw('MAX(id) as id')
            ->where('item_id', $itemId)
            ->groupBy('supplier_id');

        return ItemSupplierPrice::joinSub($latest, 'latest_prices', function ($join) {
            $join->on('item_supplier_prices.id', '=', 'latest_prices.id');
        })
            ->with(['supplier', 'item'])
            ->get();
    }

    public function saveItemSupplierPrice(Item $item, array $values) {
        return $item->supplier_prices()->updateOrCreate(['id' => $values['id'] ?? null], $values);
    }
    public function getItemBySupplier(int $supplierId) {
        $latest = ItemSupplierPrice::selectRaw('MAX(id) as id')
            ->where('supplier_id', $supplierId)
            ->groupBy('item_id');

        return ItemSupplierPrice::joinSub($latest, 'latest_prices', function ($join) {
            $join->on('item_supplier_prices.id', '=', 'latest_prices.id');
        })
            ->with(['supplier', 'item'])
            ->get();
    }
}
