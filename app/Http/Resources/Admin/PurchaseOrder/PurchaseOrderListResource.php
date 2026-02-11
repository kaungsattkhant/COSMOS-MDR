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
            'po_invoice_no' => $this->po_invoice_no,
            'po_date' => $this->po_date->format('Y-m-d'),
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'remark' => $this->remark,
            'supplier' => [
                'id' => $this->supplier->id,
                'name' => $this->supplier->name,
            ],
            'purchase_order_items' => PurchaseOrderItemListResource::collection($this->whenLoaded('purchase_order_items')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}