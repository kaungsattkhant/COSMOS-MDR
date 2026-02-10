<?php

namespace App\Http\Resources\Admin\Item;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemSupplierPriceListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'item' => [
                'id' => $this->item->id,
                'name' => $this->item->name,
                'code' => $this->item->code,
            ],
            'supplier' => [
                'id' => $this->supplier->id,
                'name' => $this->supplier->name,
                'supplier_code' => $this->supplier->supplier_code,
            ],
            'price' => $this->price,
            'effective_date' => $this->effective_date,
            'is_active' => $this->is_active,
        ];
    }
}
