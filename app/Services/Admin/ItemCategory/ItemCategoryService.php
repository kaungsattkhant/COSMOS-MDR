<?php

namespace App\Services\Admin\ItemCategory;

use App\Models\ItemCategory;
use Illuminate\Support\Facades\DB;

class ItemCategoryService
{
    public function getAll(array $data)
    {
        $query = ItemCategory::orderBy('id', 'asc');
        if (isset($data['page'])) {
            return $query->paginate($data['per_page'] ?? 20);
        }
        return $query->get();
    }

    public function getDetail(int $id)
    {
        return ItemCategory::findOrFail($id);
    }

    public function save(array $data)
    {
        return DB::transaction(
            function () use ($data) {
                $itemCategory = ItemCategory::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );
                return $itemCategory;
            }
        );
    }
}
