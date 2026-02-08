<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;

class SupplierRepository
{
    public function all(array $data)
    {
        $query = Supplier::orderBy('id', 'asc');
        
        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }
        
        return $query->get();
    }

    public function findById(int $id)
    {
        return Supplier::findOrFail($id);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return Supplier::updateOrCreate($attributes, $values);
    }
}
