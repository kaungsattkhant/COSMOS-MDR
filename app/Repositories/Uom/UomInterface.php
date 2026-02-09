<?php

namespace App\Repositories\Uom;

interface UomInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);
}
