<?php

namespace App\Repositories\Inventory;

interface InventoryInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);
}
