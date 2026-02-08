<?php

namespace App\Repositories\Item;

use App\Models\Item;

class ItemRepository
{
    public function all(array $data)
    {
        $query = Item::orderBy('id', 'asc');
        
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
}
