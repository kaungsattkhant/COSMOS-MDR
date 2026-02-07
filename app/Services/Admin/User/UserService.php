<?php

namespace App\Services\Admin\User;

use Illuminate\Support\Facades\DB;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    private $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(array $data)
    {
        return $this->repo->all($data);
    }

    public function getDetail(int $id)
    {
        return $this->repo->findById($id);
    }

    public function save(array $data)
    {
        return DB::transaction(
            function () use ($data) {
                $user = $this->repo->updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );
                if (!empty($data['permissions'])) {
                    $user->syncPermissions($data['permissions']);
                }
                return $user;
            }
        );
    }
}
