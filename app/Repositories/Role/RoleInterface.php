<?php

namespace App\Repositories\Role;

interface RoleInterface
{
    //
    public function all();
    public function updateOrCreate(array $attributes,array $values);
}
