<?php

namespace App\Services\Role;

use Illuminate\Support\Facades\DB;
use App\Repositories\Role\RoleRepository;

class RoleService
{
    protected $repo;

    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAllRole(array $data)
    {
        return $this->repo->all($data);
    }

    public function saveRole(array $data)
    {
        return DB::transaction(
            function () use ($data) {
        $role = $this->repo->updateOrCreate(
            ['id' => $data['id'] ?? null],   
            ['name' => $data['name']]
        );
        if (!empty($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }
        return $role;
            }
        );
    }
}
