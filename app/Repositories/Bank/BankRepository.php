<?php

namespace App\Repositories\Bank;

use App\Models\Bank;

class BankRepository implements BankInterface
{
    public function all(array $data)
    {
        $query = Bank::query()->orderBy('id', 'asc')
            ->when(isset($data['is_active']), fn ($q) => $q->where('is_active', $data['is_active']))
            ->when(!empty($data['search']), fn ($q) => $q->where('name', 'like', '%' . $data['search'] . '%'));

        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }
        return $query->get();
    }

    public function findById(int $id)
    {
        return Bank::findOrFail($id);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return Bank::updateOrCreate($attributes, $values);
    }
}
