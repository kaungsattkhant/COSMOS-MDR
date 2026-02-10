<?php

namespace App\Repositories\Item;

use App\Models\Item;

interface ItemInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);

    public function getItemSupplierPrice(int $itemId);  

    public function saveItemSupplierPrice(Item $item,array $values);
}
