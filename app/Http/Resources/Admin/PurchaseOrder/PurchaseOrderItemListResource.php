<?php

namespace App\Http\Resources\Admin\PurchaseOrder;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderItemListResource extends JsonResource
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
            'quantity' => $this->quantity,
            'purchase_price' => $this->purchase_price,
            'sub_total' => $this->sub_total,
        ];
    }
}