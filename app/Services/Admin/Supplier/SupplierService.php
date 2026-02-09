<?php

namespace App\Services\Admin\Supplier;

use Illuminate\Support\Facades\DB;
use App\Repositories\Supplier\SupplierInterface;

class SupplierService
{
    protected $repo;

    public function __construct(SupplierInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAllSuppliers(array $data)
    {
        return $this->repo->all($data);
    }

    public function getSupplierDetail(int $id)
    {
        return $this->repo->findById($id);
    }

    public function saveSupplier(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->repo->updateOrCreate(
                ['id' => $data['id'] ?? null],
                [
                    'name'                => $data['name'],
                    'supplier_code'       => $data['supplier_code'] ?? null,
                    'phone_number'        => $data['phone_number'] ?? null,
                    'email'               => $data['email'] ?? null,
                    'address'             => $data['address'] ?? null,
                    'bank_id'             => $data['bank_id'] ?? null,
                    'bank_account_no'     => $data['bank_account_no'] ?? null,
                    'credit_limit_amount' => $data['credit_limit_amount'] ?? null,
                    'is_active'           => $data['is_active'] ?? true,
                ]
            );
        });
    }
}
