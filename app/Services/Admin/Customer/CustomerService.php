<?php

namespace App\Services\Admin\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function getAllCustomer(array $data)
    {
        $query = Customer::query()->orderBy('id', 'asc')->filter($data);
        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }
        return $query->get();
    }

    public function getCustomerDetail(int $id)
    {
        return Customer::findOrFail($id);
    }

    public function saveCustomer(array $data)
    {
        return DB::transaction(
            function () use ($data) {
                $customer = Customer::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );
                return $customer;
            }
        );
    }
}
