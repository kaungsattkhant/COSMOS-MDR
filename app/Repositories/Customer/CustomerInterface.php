<?php

namespace App\Repositories\Customer;

interface CustomerInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);
}
