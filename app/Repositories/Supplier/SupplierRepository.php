<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;

class SupplierRepository implements SupplierInterface
{
    public function all(array $data)
    {
        $query = Supplier::query()->with('bank')->orderBy('id', 'asc')->filter($data);

        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }

        return $query->get();
    }

    public function findById(int $id)
    {
        return Supplier::with('bank')->findOrFail($id);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return Supplier::updateOrCreate($attributes, $values);
    }
    
}
