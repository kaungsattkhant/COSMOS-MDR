<?php

namespace App\Http\Resources\Admin\PurchaseOrder;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderListResource extends JsonResource
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
            'supplier' => [
                'id' => $this->supplier->id,
                'name' => $this->supplier->name,
            ],
            'purchase_date' => $this->purchase_date->format('Y-m-d'),
            'reference_no' => $this->reference_no,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'notes' => $this->notes,
            'purchase_order_items' => PurchaseOrderItemListResource::collection($this->whenLoaded('purchase_order_items')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}