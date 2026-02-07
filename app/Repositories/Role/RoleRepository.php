<?php

namespace App\Repositories\Role;

use App\Models\Role;

class RoleRepository
{

    public function all(array $data) {
        $roleQuery= Role::orderBy('id','asc');
        if(isset($data['page'])){
            return $roleQuery->paginate($data['per_page'] ?? 20);
        }
        return $roleQuery->get();
    }
    public function findById(int $roleId){
        return Role::findOrFail($roleId);
    }
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return Role::updateOrCreate($attributes, $values);
    }
}
