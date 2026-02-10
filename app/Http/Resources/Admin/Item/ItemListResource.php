<?php

namespace App\Http\Resources\Admin\Item;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'code'              => $this->code,
            'name'              => $this->name,
            'description'       => $this->description,
            'uom_id'  => $this->uom_id,
            'item_category_id'  => $this->item_category_id,
            'item_category'     => $this->item_category,
            'uom'     => $this->uom,
            'supplier_prices'   => $this->supplier_prices,
            'is_active'         => $this->is_active,
        ];
    }
}
