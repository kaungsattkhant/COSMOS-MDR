<?php

namespace App\Repositories\Bank;

use App\Models\Bank;

class BankRepository implements BankInterface
{
    public function all(array $data)
    {
        $query = Bank::query()->orderBy('id', 'asc')->filter($data);

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
