<?php

namespace App\Services\Admin\Bank;

use Illuminate\Support\Facades\DB;
use App\Repositories\Bank\BankInterface;

class BankService
{
    protected $repo;

    public function __construct(BankInterface $repo)
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
        return DB::transaction(function () use ($data) {
            return $this->repo->updateOrCreate(
                ['id' => $data['id'] ?? null],
                [
                    'name'      => $data['name'],
                    'is_active' => $data['is_active'] ?? true,
                ]
            );
        });
    }
}
