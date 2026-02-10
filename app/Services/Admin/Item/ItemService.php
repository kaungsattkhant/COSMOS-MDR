<?php

namespace App\Services\Admin\Item;

use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Repositories\Item\ItemInterface;
use App\Http\Resources\Admin\Item\ItemListResource;

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
            $item = $this->repo->updateOrCreate(
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
            if (!empty($data['supplier_prices'])) {
                foreach ($data['supplier_prices'] as $priceData) {
                    $this->repo->saveItemSupplierPrice(
                        $item,$priceData
                    );
                }
            }
            return new ItemListResource($item);
        });
    }

    public function getItemSupplierPrice(int $itemId)
    {
        return $this->repo->getItemSupplierPrice($itemId);
    }

    public function storeItemSupplierPrice(array $data)
    {
        $item = Item::findOrFail($data['item_id']);
        return $this->repo->saveItemSupplierPrice($item,$data);
    }
}
