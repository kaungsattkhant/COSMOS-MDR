<?php

namespace App\Repositories\Supplier;

interface SupplierInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);
}
