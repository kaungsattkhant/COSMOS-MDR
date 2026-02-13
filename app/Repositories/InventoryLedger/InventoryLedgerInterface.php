<?php

namespace App\Repositories\InventoryLedger;

interface InventoryLedgerInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);
}
