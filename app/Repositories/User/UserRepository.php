<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    public function all(array $data)
    {
        $query = User::orderBy('id', 'asc');
        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }
        return $query->get();
    }
    public function findById(int $id)
    {
        return User::findOrFail($id);
    }
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return User::updateOrCreate($attributes, $values);
    }
}
