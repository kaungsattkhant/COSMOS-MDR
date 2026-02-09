<?php

namespace App\Repositories\Bank;

interface BankInterface
{
    public function all(array $data);

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values = []);
}
