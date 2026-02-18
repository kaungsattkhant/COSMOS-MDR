<?php

namespace App\Repositories\PurchaseOrder;

interface PurchaseOrderInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);

    public function partialReceived(array $data);

    public function getPartialReceive(array $data);

    public function updatePartialReceiveStatus(array $data);
}