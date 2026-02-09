<?php

namespace App\Services\Admin\Item;

use Illuminate\Support\Facades\DB;
use App\Repositories\Item\ItemInterface;

class ItemService
{
    protected $repo;

    public function __construct(ItemInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAllItems(array $data)
    {
        return $this->repo->all($data);
    }

    public function getItemDetail(int $id)
    {
        return $this->repo->findById($id);
    }

    public function saveItem(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->repo->updateOrCreate(
                ['id' => $data['id'] ?? null],
                [
                    'code'              => $data['code'],
                    'name'              => $data['name'],
                    'description'       => $data['description'] ?? null,
                    'unit'              => $data['unit'] ?? null,
                    'is_active'         => $data['is_active'] ?? true,
                    'item_category_id'  => $data['item_category_id'] ?? null,
                ]
            );
        });
    }
}
