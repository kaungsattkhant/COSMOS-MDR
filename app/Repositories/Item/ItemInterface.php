<?php

namespace App\Repositories\Item;

interface ItemInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);
}
