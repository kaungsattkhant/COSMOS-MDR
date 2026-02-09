<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\Customer\CustomerInterface;

class CustomerRepository implements CustomerInterface
{
    public function all(array $data)
    {
        $query = Customer::query()->orderBy('id', 'asc')->filter($data);

        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }

        return $query->get();
    }

    public function findById(int $id)
    {
        return Customer::findOrFail($id);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return Customer::updateOrCreate($attributes, $values);
    }
}
