<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function all();

    public function findById(int $id);

    public function updateOrCreate(array $attributes, array $values);
}
