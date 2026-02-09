<?php

namespace App\Services\Admin\Uom;

use Illuminate\Support\Facades\DB;
use App\Repositories\Uom\UomInterface;

class UomService
{
    protected $repo;

    public function __construct(UomInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAllUoms(array $data)
    {
        return $this->repo->all($data);
    }

    public function getUomDetail(int $id)
    {
        return $this->repo->findById($id);
    }

    public function saveUom(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->repo->updateOrCreate(
                ['id' => $data['id'] ?? null],
                [   
                    'name'      => $data['name'],
                    'uom_code'      => $data['uom_code'],
                    'is_active' => $data['is_active'] ?? true,
                ]
            );
        });
    }
}
